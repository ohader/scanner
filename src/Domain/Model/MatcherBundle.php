<?php
namespace TYPO3\CMS\Scanner\Domain\Model;

use TYPO3\CMS\Scanner\Utility;

class MatcherBundle
{
    /**
     * @var string
     */
    private $configurationPath;

    /**
     * @var string
     */
    private $documentationPath;

    /**
     * @var string[]
     */
    private $classNames;

    /**
     * @var array
     */
    private $configuration;

    public function __construct(
        string $configurationPath,
        string $documentationPath,
        string ...$classNames
    )
    {
        if (!is_dir($configurationPath)) {
            throw new \RuntimeException(
                sprintf('Path "%s" does not exist', $configurationPath),
                1507203231
            );
        }
        if (empty($classNames)) {
            throw new \RuntimeException(
                'No matcher class names given',
                1507203232
            );
        }

        $this->configurationPath = Utility::ensureTrailingDirectorySeparator(
            $configurationPath
        );
        $this->documentationPath = Utility::ensureTrailingDirectorySeparator(
            $documentationPath
        );

        $this->classNames = $classNames;
        $this->configuration = $this->buildConfiguration();
    }

    /**
     * @return array
     */
    public function getConfiguration(): array
    {
        return $this->configuration;
    }

    private function buildConfiguration(): array
    {
        return array_map(
            function (string $matcherClassName) {
                $lastClassPart = $this->extractLastClassPart($matcherClassName);
                return [
                    'class' => $matcherClassName,
                    'restFilePath' => $this->documentationPath,
                    'configurationFile' => $this->configurationPath . $lastClassPart . '.php',
                ];
            },
            $this->classNames
        );
    }

    private function extractLastClassPart(string $className): string
    {
        $parts = explode('\\', $className);
        return array_pop($parts);
    }
}