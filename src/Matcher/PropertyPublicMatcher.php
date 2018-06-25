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
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Identifier;

/**
 * Find usages of properties which were removed / deprecated.
 */
class PropertyPublicMatcher extends AbstractCoreMatcher
{
    /**
     * Prepare $this->flatMatcherDefinitions once and validate config
     *
     * @param array $matcherDefinitions Incoming main configuration
     */
    public function __construct(array $matcherDefinitions)
    {
        $this->matcherDefinitions = $matcherDefinitions;
        $this->validateMatcherDefinitions();
        $this->initializeFlatMatcherDefinitions();
    }

    /**
     * Called by PhpParser.
     *
     * @param Node $node
     */
    public function enterNode(Node $node)
    {
        // Match property access (not static)
        if (!$this->isFileIgnored($node)
            && !$this->isLineIgnored($node)
            && $node instanceof PropertyFetch
            && $node->name instanceof Identifier
            && in_array($node->name->name, array_keys($this->flatMatcherDefinitions), true)
        ) {
            $match = [
                'restFiles' => [],
                'line' => $node->getAttribute('startLine'),
                'subject' => $node->name->name,
                'message' => 'Fetch of property "' . $node->name->name . '"',
                'indicator' => static::INDICATOR_WEAK,
            ];

            foreach ($this->flatMatcherDefinitions[$node->name->name]['candidates'] as $candidate) {
                $match['restFiles'] = array_unique(array_merge($match['restFiles'], $candidate['restFiles']));
            }
            $this->matches[] = $match;
        }
    }
}
