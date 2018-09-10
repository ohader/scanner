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
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ArrayItem;
use PhpParser\Node\Scalar\String_;

/**
 * Find usages of dropped TCA configuration values and other
 * nested array structures.
 *
 * You can specify the `matchOnValues` parameter to pass in an array
 * of values to match.
 *
 * Remember array startline with the match so we can skip
 * traversal of nodes after we have found a match.
 */
class ArrayMatcher extends AbstractCoreMatcher
{
    /**
     * @var array
     */
    protected $matchedNodes = [];

    /**
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
     * @param Node $node
     */
    public function enterNode(Node $node)
    {
        if (!$this->isFileIgnored($node)
            && !$this->isLineIgnored($node)
            && $node instanceof Array_
        ) {
            $flatArray = $this->flattenArray($node);

            foreach ($this->matcherDefinitions as $candidateKey => $candidate) {
                $candidateKey = '/' . ltrim($candidateKey, '/');
                /**
                 * @var string $flatKey
                 * @var ArrayItem $nodeItem
                 */
                foreach ($flatArray as $flatKey => $nodeItem) {
                    if (\strlen($candidateKey) > \strlen($flatKey)) {
                        continue;
                    }
                    if (($candidateKey === $flatKey
                            || substr($flatKey, -\strlen($candidateKey)) === $candidateKey)
                        && !\in_array($nodeItem->getStartLine() . $candidateKey, $this->matchedNodes, true)
                    ) {
                        if (array_key_exists('matchOnValues', $candidate) && !$this->nodeValueMatches($nodeItem->value, $candidate['matchOnValues'])) {
                            continue;
                        }
                        $match = [
                            'restFiles' => [],
                            'line' => $nodeItem->getStartLine(),
                            'subject' => $nodeItem->key->value,
                            'message' => 'Usage of array key "' . $nodeItem->key->value . '"',
                            'indicator' => substr_count($candidateKey, '/') > 1 ? static::INDICATOR_STRONG : static::INDICATOR_WEAK,
                        ];
                        $match['restFiles'] = array_unique(array_merge($match['restFiles'], $candidate['restFiles']));
                        $this->matches[] = $match;
                        $this->matchedNodes[] = $nodeItem->getStartLine() . $candidateKey;
                    }
                }
            }
        }
    }

    /**
     * Flatten the AST Array_ object into a simple array indexed with the same key
     * used in the matcher.
     *
     * This will result in an array of keys containing the 'end' nodeItem objects.
     *
     * @param $node
     * @param string $prefix
     * @return array
     */
    protected function flattenArray($node, $prefix = '/')
    {
        $result = [];
        /** @var ArrayItem $nodeItem */
        foreach ($node->items as $nodeItem) {
            if ($nodeItem->value instanceof Array_ && $nodeItem->value->items) {
                if ($nodeItem instanceof ArrayItem && $nodeItem->key instanceof String_) {
                    $result += $this->flattenArray($nodeItem->value, $prefix . $nodeItem->key->value . '/');
                }
            } else {
                if ($nodeItem instanceof ArrayItem && $nodeItem->key instanceof String_) {
                    $result[$prefix . $nodeItem->key->value] = $nodeItem;
                }
            }
        }
        return $result;
    }

    /**
     * Try to extract the value from the node and match it to the array of available matches
     *
     * @param object $nodeValue
     * @param array $matches
     * @return bool
     */
    protected function nodeValueMatches($nodeValue, $matches = [])
    {
        $value = null;
        switch (\get_class($nodeValue)) {
            case Node\Scalar\LNumber::class:
                $value = $nodeValue->value;
                break;
            case Node\Expr\ConstFetch::class:
                $parts = $nodeValue->name->parts;
                if (\count($parts) === 1) {
                    $value = $parts[0];
                }
                break;
            default:
                if (isset($nodeValue->value)) {
                    $value = $nodeValue->value;
                }
        }

        return \in_array($value, $matches, true);
    }
}
