<?php
declare(strict_types=1);
namespace TYPO3\CMS\Scanner\Matcher;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use PhpParser\NodeVisitor;
use TYPO3\CMS\Scanner\CodeScannerInterface;

/**
 * Factory preparing matcher instances
 */
class MatcherFactory
{
    /**
     * Create matcher instances and hand over configuration.
     *
     * @param array $matcherConfigurations Incoming configuration array
     * @return NodeVisitor[]&CodeScannerInterface[]
     * @throws \RuntimeException
     */
    public function createAll(array $matcherConfigurations)
    {
        $instances = [];
        foreach ($matcherConfigurations as $matcherConfiguration) {
            if (empty($matcherConfiguration['class'])) {
                throw new \RuntimeException(
                    'Each matcher must have a class name',
                    1501415721
                );
            }

            if (empty($matcherConfiguration['configurationFile']) && !isset($matcherConfiguration['configurationArray'])) {
                throw new \RuntimeException(
                    'Each matcher must have either a configurationFile or configurationArray defined',
                    1501416365
                );
            }

            if (isset($matcherConfiguration['configurationFile']) && isset($matcherConfiguration['configurationArray'])) {
                throw new \RuntimeException(
                    'Having both a configurationFile and configurationArray is invalid',
                    1501419367
                );
            }

            $configuration = [];
            if (isset($matcherConfiguration['configurationFile'])) {
                $configuration = $matcherConfiguration['configurationFile'];
                if (empty($configuration) || !is_file($configuration)) {
                    throw new \RuntimeException(
                        'Configuration file ' . $matcherConfiguration['configurationFile'] . ' not found',
                        1501509605
                    );
                }
                $configuration = require $configuration;
                if (!is_array($configuration)) {
                    throw new \RuntimeException(
                        'Configuration file ' . $matcherConfiguration['configurationFile'] . ' must return an array',
                        1501509548
                    );
                }
            }

            if (isset($matcherConfiguration['configurationArray'])) {
                if (!is_array($matcherConfiguration['configurationArray'])) {
                    throw new \RuntimeException(
                        'Configuration array ' . $matcherConfiguration['configurationArray'] . ' must not be empty',
                        1501509738
                    );
                }
                $configuration = $matcherConfiguration['configurationArray'];
            }

            $configuration = $this->extendConfiguration(
                $configuration,
                $matcherConfiguration
            );
            $matcherInstance = new $matcherConfiguration['class']($configuration);
            if (!$matcherInstance instanceof CodeScannerInterface
                || !$matcherInstance instanceof NodeVisitor) {
                throw new \RuntimeException(
                    'Matcher ' . $matcherConfiguration['class'] . ' must implement CodeScannerInterface'
                    . ' and NodeVisitor',
                    1501510168
                );
            }
            $instances[] = $matcherInstance;
        }
        return $instances;
    }

    private function extendConfiguration(
        array $configuration,
        $matcherConfiguration
    ): array
    {
        if (isset($matcherConfiguration['restFilePath'])) {
            $restFilePath = $matcherConfiguration['restFilePath'];
            array_walk(
                $configuration,
                function (array &$aspect) use ($restFilePath) {
                    if (empty($aspect['restFiles'])) {
                        return;
                    }
                    $aspect['restFiles'] = array_map(
                        function (string $restFile) use ($restFilePath) {
                            return $restFilePath . $restFile;
                        },
                        $aspect['restFiles']
                    );
                }
            );
        }

        return $configuration;
    }
}
