<?php
namespace TYPO3\CMS\Scanner;

use PhpParser\Error;
use PhpParser\Parser;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use TYPO3\CMS\Scanner\Domain\Model\DirectoryMatches;
use TYPO3\CMS\Scanner\Domain\Model\FileMatches;
use TYPO3\CMS\Scanner\Domain\Model\Match;
use TYPO3\CMS\Scanner\Domain\Model\MatcherBundleCollection;
use TYPO3\CMS\Scanner\Matcher\AbstractCoreMatcher;
use TYPO3\CMS\Scanner\Visitor\TraverserFactory;

class Scanner
{
    private $finder;
    private $parser;
    private $traverserFactory;

    /**
     * @var array
     */
    private $typeRanking = [
        Match::TYPE_BREAKING => 100,
        Match::TYPE_DEPRECATION => 80,
        Match::TYPE_IMPORTANT => 50,
        Match::TYPE_FEATURE => 20
    ];

    public function __construct(
        Finder $finder,
        Parser $parser,
        TraverserFactory $traverserFactory
    )
    {
        $this->finder = $finder;
        $this->parser = $parser;
        $this->traverserFactory = $traverserFactory;
    }

    public function scanPath(
        string $path,
        MatcherBundleCollection $collection
    ): DirectoryMatches
    {
        if (!is_dir($path)) {
            throw new \RuntimeException(
                sprintf('Path "%s" does not exist', $path),
                1507203233
            );
        }

        $directoryMatches = new DirectoryMatches($path);
        $files = $this->finder->files()
            ->in(Utility::removeTrailingDirectorySeparator($path))
            ->name('*.php');

        /** @var SplFileInfo $file */
        foreach ($files as $file) {
            $fileMatches = $this->scanFile(
                $file->getPathname(),
                $collection
            );
            if ($fileMatches->count() !== 0) {
                $directoryMatches[] = $fileMatches;
            }
        }

        return $directoryMatches;
    }

    public function scanFile(
        string $file,
        MatcherBundleCollection $collection
    ): FileMatches
    {
        if (!file_exists($file)) {
            throw new \RuntimeException(
                sprintf('File "%s" does not exist', $file),
                1507203234
            );
        }

        try {
            $statements = $this->parser->parse(
                file_get_contents($file)
            );
        } catch (Error $error) {
            return $this->buildParseExceptionFileMatches($file, $error);
        }

        $matchers = $this->traverserFactory->createMatchers($collection);
        $traverser = $this->traverserFactory->createTraverser(...$matchers);
        $traverser->traverse($statements);

        return new FileMatches($file, ...$this->buildMatches(...$matchers));
    }

    /**
     * @param CodeScannerInterface[] ...$matchers
     * @return Match[]
     */
    private function buildMatches(CodeScannerInterface ...$matchers): array
    {
        $matcherMatches = array_map(
            function (CodeScannerInterface $matcher) {
                return array_map(
                    function (array $result) use ($matcher) {
                        return array_merge(
                            ['matcher' => get_class($matcher)],
                            $result
                        );
                    },
                    $matcher->getMatches()
                );
            },
            $matchers
        );

        return array_map(
            function (array $result) {
                if (!empty($result['restFiles'])) {
                    $type = $this->inferTypeFromRestFiles($result['restFiles']);
                }
                $match = new Match(
                    $result['matcher'],
                    $result['indicator'],
                    isset($result['subject']) ? $result['subject'] : '',
                    $result['message'],
                    $result['line'],
                    !empty($type) ? $type : Match::TYPE_IMPORTANT
                );
                if (!empty($result['restFiles'])) {
                    $match->setRestFiles($result['restFiles']);
                }
                return $match;
            },
            array_merge(...$matcherMatches)
        );
    }

    private function buildParseExceptionFileMatches(
        string $file,
        Error $error
    ): FileMatches
    {
        $match = new Match(
            get_class($error),
            AbstractCoreMatcher::INDICATOR_IMPOSSIBLE,
            $file,
            $error->getMessage(),
            $error->getStartLine(),
            Match::TYPE_BREAKING
        );
        return new FileMatches($file, $match);
    }

    private function inferTypeFromRestFiles(array $restFiles): string
    {
        $type = '';
        foreach ($restFiles as $restFile) {
            $fileType = $this->extractFileType($restFile);
            $type = $this->getHigherType($type, $fileType);
            if ($type === Match::TYPE_BREAKING) {
                // breaking is the highest type, return if this type is found.
                break;
            }
        }
        return $type;
    }

    private function extractFileType(string $restFile): string
    {
        list($fileType) = explode('-', basename($restFile));
        return strtoupper($fileType);
    }

    private function getHigherType(string $type, string $fileType): string
    {
        if (empty($type)) {
            return $fileType;
        }
        return ($this->typeRanking[$fileType] > $this->typeRanking[$type]) ? $fileType : $type;
    }
}