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

use PhpParser\Node;
use PhpParser\Node\Name\FullyQualified;

/**
 * Find usages of class / interface names which are entirely deprecated or removed
 */
class ClassNamePatternMatcher extends AbstractCoreMatcher
{
    /**
     * Default constructor validates matcher definition.
     *
     * @param array $matcherDefinitions Incoming main configuration
     */
    public function __construct(array $matcherDefinitions)
    {
        $this->matcherDefinitions = $matcherDefinitions;
        $this->validateMatcherDefinitions();
    }

    /**
     * Called by PhpParser.
     *
     * @param Node $node Given node to test
     * @return void
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof FullyQualified
            || $this->isFileIgnored($node)
            || $this->isLineIgnored($node)
        ) {
            return;
        }

        $fullyQualifiedClassName = $node->toString();
        $matchedPattern = $this->match($fullyQualifiedClassName);
        if ($matchedPattern === null) {
            return;
        }

        $this->matches[] = [
            'restFiles' => $this->matcherDefinitions[$matchedPattern]['restFiles'],
            'line' => $node->getAttribute('startLine'),
            'subject' => $fullyQualifiedClassName,
            'message' => 'Usage of class "' . $fullyQualifiedClassName . '"',
            'indicator' => static::INDICATOR_STRONG,
        ];
    }

    private function match(string $value)
    {
        foreach (array_keys($this->matcherDefinitions) as $pattern) {
            if (preg_match($pattern, $value)) {
                return $pattern;
            }
        }

        return null;
    }
}