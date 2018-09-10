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
use PhpParser\Node\Expr\ArrayDimFetch;

/**
 * Find usages of dropped configuration values and hook registrations.
 * Matches on "last" keys only.
 * Definition of $GLOBALS['foo']['bar'] and usage as $foo['bar'] matches.
 *
 * If rule specifies the 'numberOfKeysToMatch' parameter, multiple 'last'
 * keys will need to match.
 *
 *     '$GLOBALS[\'TBE_MODULES_EXT\'][\'xMOD_alt_clickmenu\'][\'extendCMclasses\'][\'path\']' => [
 *         'numberOfKeysToMatch' => 3,
 *         'restFiles' => [
 *             'Breaking-61781-IncludeOnceArrayOfClickMenuControllerRemoved.rst',
 *         ],
 *     ],
 *
 * This will only mactch arrays containing at least: ['xMOD_alt_clickmenu']['extendCMclasses']['path']
 *
 */
class ArrayDimensionMatcher extends AbstractCoreMatcher
{
    /**
     * Initialize "flat" matcher array from matcher definitions.
     *
     * @param array $matcherDefinitions Incoming main configuration
     */
    public function __construct(array $matcherDefinitions)
    {
        $this->matcherDefinitions = $matcherDefinitions;
        $this->validateMatcherDefinitions();
        $this->initializeLastArrayKeysNameArray();
    }

    /**
     * Called by PhpParser.
     *
     * @param Node $node
     */
    public function enterNode(Node $node)
    {
        if (!$this->isFileIgnored($node)
            && !$this->isLineIgnored($node)
            && $node instanceof ArrayDimFetch
            && isset($node->dim->value)
            && array_key_exists($node->dim->value, $this->flatMatcherDefinitions)
        ) {
            foreach ($this->flatMatcherDefinitions[$node->dim->value]['candidates'] as $candidate) {
                $matchFound = false;
                $currentNode = $node;
                foreach ($candidate['matchKeys'] as $key) {
                    if (isset($currentNode->dim->value) && $key !== $currentNode->dim->value) {
                        $matchFound = false;
                        break;
                    }
                    $matchFound = true;
                    if ($this->hasParentArraySegment($currentNode)) {
                        $currentNode = $currentNode->var;
                    }
                }
                if ($matchFound) {
                    $match = [
                        'restFiles' => [],
                        'line' => $node->getAttribute('startLine'),
                        'subject' => $node->dim->value,
                        'message' => 'Access to array key "' . $node->dim->value . '"',
                        'indicator' => static::INDICATOR_WEAK,
                    ];
                    if (\count($candidate['matchKeys']) > 1) {
                        $match['message'] = 'Access to array keys "[\'' . implode("']['", array_reverse($candidate['matchKeys'])) . '\']"';
                    }
                    $match['restFiles'] = array_unique(array_merge($match['restFiles'], $candidate['restFiles']));
                    $this->matches[] = $match;
                }
            }
        }
    }

    /**
     * Prepare 'lastKey' => [$details] array in flatMatcherDefinitions
     *
     * This will enable the matcher to fail early if the last segment
     * does not match any segments in the index of this array.
     */
    protected function initializeLastArrayKeysNameArray()
    {
        $methodNameArray = [];
        foreach ($this->matcherDefinitions as $fullArrayString => $details) {
            $numberOfKeysToMatch = 1;
            if (array_key_exists('numberOfKeysToMatch', $details)) {
                $numberOfKeysToMatch = $details['numberOfKeysToMatch'];
            }

            $matchKeys = $this->getMatchKeys($fullArrayString, $numberOfKeysToMatch);
            $lastKey = $matchKeys[0];
            $details['matchKeys'] = $matchKeys;

            if (!array_key_exists($lastKey, $methodNameArray)) {
                $methodNameArray[$lastKey]['candidates'] = [];
            }
            $methodNameArray[$lastKey]['candidates'][] = $details;
        }

        $this->flatMatcherDefinitions = $methodNameArray;
    }

    /**
     * Find keys of an array written as a string
     * e.g. find last part "foobar" of an array path "$foo['bar']['foobar']"
     *
     * Or if keys > 1: find "foobar" and "bar"
     *
     * For a count of 2, this would return ['foobar', 'bar']
     *
     * @param $string
     * @param int $keyCount
     *
     * @return array
     */
    protected function getMatchKeys($string, $keyCount = 1): array
    {
        $count = 0;
        $matchKeys = [];
        while ($count < $keyCount) {
            // Trim off last '] or ']['
            $string = rtrim($string, '\'][');

            // Get the last part of the string after the single quote: '
            $lastKey = substr(strrchr($string, "''"), 1);

            // Trim off the last key from the string
            $string = str_replace($lastKey, '', $string);

            $matchKeys[] = $lastKey;
            $count++;
        }

        return $matchKeys;
    }

    /**
     * Check if node contains a segment with parent information
     *
     * @param $node
     * @return bool
     */
    protected function hasParentArraySegment($node): bool
    {
        return ($node->var instanceof ArrayDimFetch && $node->var->dim !== null);
    }
}
