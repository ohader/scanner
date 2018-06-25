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

use PhpParser\Comment\Doc;
use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;

/**
 * Find usages of method annotations
 */
class MethodAnnotationMatcher extends AbstractCoreMatcher
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
    }

    /**
     * Called by PhpParser.
     * Test for method annotations (strong match)
     *
     * @param Node $node
     */
    public function enterNode(Node $node)
    {
        if ($node instanceof ClassMethod
            && ($docComment = $node->getDocComment()) instanceof Doc
            && !$this->isFileIgnored($node)
            && !$this->isLineIgnored($node)
        ) {
            $isPossibleMatch = false;
            $match = [
                'restFiles' => [],
                'subject' => $node->name,
                'line' => $node->getAttribute('startLine'),
                'indicator' => static::INDICATOR_STRONG,
            ];

            $matches = [];
            preg_match_all(
                '/\s*\s@(?<annotations>[^\s.]*).*\n/',
                $docComment->getText(),
                $matches
            );

            foreach ($matches['annotations'] as $annotation) {
                $annotation = '@' . $annotation;

                if (!isset($this->matcherDefinitions[$annotation])) {
                    continue;
                }

                $isPossibleMatch = true;
                $match['message'] = 'Method "' . $node->name . '" uses an ' . $annotation . ' annotation.';
                $match['restFiles'] = array_unique(array_merge(
                    $match['restFiles'],
                    $this->matcherDefinitions[$annotation]['restFiles']
                ));
            }

            if ($isPossibleMatch) {
                $this->matches[] = $match;
            }
        }
    }
}
