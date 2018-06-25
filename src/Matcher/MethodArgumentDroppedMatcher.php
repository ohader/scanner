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
use PhpParser\Node\Expr\MethodCall;
use TYPO3\CMS\Scanner\CodeScannerInterface;

/**
 * Find usages of method calls which changed signature and dropped arguments,
 * but are called with more arguments.
 * This is a "weak" match since we're just testing for method name
 * but not connected class.
 */
class MethodArgumentDroppedMatcher extends AbstractCoreMatcher implements CodeScannerInterface
{
    /**
     * Prepare $this->flatMatcherDefinitions once and validate config
     *
     * @param array $matcherDefinitions Incoming main configuration
     */
    public function __construct(array $matcherDefinitions)
    {
        $this->matcherDefinitions = $matcherDefinitions;
        $this->validateMatcherDefinitions(['maximumNumberOfArguments']);
        $this->initializeFlatMatcherDefinitions();
    }

    /**
     * Called by PhpParser.
     * Test for "->deprecated()" (weak match)
     *
     * @param Node $node
     */
    public function enterNode(Node $node)
    {
        // Match method call (not static)
        if (!$this->isFileIgnored($node)
            && !$this->isLineIgnored($node)
            && $node instanceof MethodCall
            && in_array($node->name->name, array_keys($this->flatMatcherDefinitions), true)
        ) {
            $match = [
                'restFiles' => [],
                'line' => $node->getAttribute('startLine'),
                'indicator' => static::INDICATOR_WEAK,
            ];

            $isArgumentUnpackingUsed = $this->isArgumentUnpackingUsed($node->args);

            $numberOfArguments = count($node->args);
            $isPossibleMatch = false;
            foreach ($this->flatMatcherDefinitions[$node->name->name]['candidates'] as $candidate) {
                // A method call is considered a match if it is not called with argument unpacking
                // and number of used arguments is higher than maximumNumberOfArguments
                if (!$isArgumentUnpackingUsed
                    && $numberOfArguments > $candidate['maximumNumberOfArguments']
                ) {
                    $isPossibleMatch = true;
                    $match['subject'] = $node->name;
                    $match['message'] = 'Method "' . $node->name . '()" supports only ' . $candidate['maximumNumberOfArguments'] . ' arguments.';
                    $match['restFiles'] = array_unique(array_merge($match['restFiles'], $candidate['restFiles']));
                }
            }
            if ($isPossibleMatch) {
                $this->matches[] = $match;
            }
        }
    }
}
