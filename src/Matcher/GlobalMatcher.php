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
use PhpParser\Node\Expr\Variable;

/**
 * Match access to a one dimensional '$GLOBAL' array
 * Example "$TT"
 */
class GlobalMatcher extends AbstractCoreMatcher
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
            && $node instanceof Node\Expr\MethodCall
            && $node->var instanceof Variable
            && $node->var->name !== 'GLOBALS'
            && in_array(
                '$' . $node->var->name,
                array_keys($this->matcherDefinitions),
                true
            )
        ) {
            $this->matches[] = [
                'restFiles' => $this->matcherDefinitions['$' . $node->var->name]['restFiles'],
                'line' => $node->getAttribute('startLine'),
                'subject' => $node->var->name,
                'message' => 'Usage of global "' . $node->var->name . '"',
                'indicator' => static::INDICATOR_STRONG,
            ];
        }
    }
}
