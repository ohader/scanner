<?php
namespace TYPO3\CMS\Scanner;

use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\Parser;
use PhpParser\ParserFactory;
use Symfony\Component\Finder\Finder;
use TYPO3\CMS\Scanner\Domain\Model\MatcherBundle;
use TYPO3\CMS\Scanner\Matcher\MatcherFactory;
use TYPO3\CMS\Scanner\Visitor\CodeStatistics;
use TYPO3\CMS\Scanner\Visitor\GeneratorClassesResolver;
use TYPO3\CMS\Scanner\Visitor\TraverserFactory;

class ScannerFactory
{
    private $parserFactory;
    private $traverserFactory;

    public static function create()
    {
        return new static(
            new ParserFactory(),
            new TraverserFactory(
                new MatcherFactory()
            )
        );
    }

    public function __construct(
        ParserFactory $parserFactory,
        TraverserFactory $traverserFactory
    )
    {
        $this->parserFactory = $parserFactory;
        $this->traverserFactory = $traverserFactory;
    }

    public function createFor(
        int $kind = ParserFactory::PREFER_PHP7
    ): Scanner
    {
        $finder = new Finder();
        $parser = $this->parserFactory->create($kind);

        return new Scanner(
            $finder,
            $parser,
            $this->traverserFactory
        );
    }
}