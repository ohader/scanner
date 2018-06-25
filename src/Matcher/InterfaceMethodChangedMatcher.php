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
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;

/**
 * Matches interface method arguments which have been dropped.
 *
 * This does *not* test if a class implements an interface.
 * The scanner only looks for:
 * - Class method names not having specified number of arguments
 * - Method calls with given method name not having this number of arguments
 */
class InterfaceMethodChangedMatcher extends AbstractCoreMatcher
{
    /**
     * Default constructor validates config
     *
     * @param array $matcherDefinitions Incoming main configuration
     */
    public function __construct(array $matcherDefinitions)
    {
        $this->matcherDefinitions = $matcherDefinitions;
        // newNumberOfArguments must exist in all matcherDefinitions
        $this->validateMatcherDefinitions(['newNumberOfArguments']);
    }

    /**
     * Called by PhpParser.
     * Test for "public function like($arg1, $arg2, $arg3) {}" (weak match)
     * Test for "->like($arg1, $arg2, $arg3); (weak match)
     *
     * @param Node $node
     * @return null|void
     */
    public function enterNode(Node $node)
    {
        if ($this->isFileIgnored($node) || $this->isLineIgnored($node)) {
            return;
        }

        // Match method name of a class, must be public, wouldn't make sense as interface if protected/private
        if ($node instanceof ClassMethod
            && in_array($node->name->name, array_keys($this->matcherDefinitions), true)
            && $node->flags & Class_::MODIFIER_PUBLIC // public
            && ($node->flags & Class_::MODIFIER_STATIC) !== Class_::MODIFIER_STATIC // not static
        ) {
            $methodName = $node->name->name;
            $numberOfUsedArguments = 0;
            if (isset($node->params) && is_array($node->params)) {
                $numberOfUsedArguments = count($node->params);
            }
            $numberOfAllowedArguments = $this->matcherDefinitions[$methodName]['newNumberOfArguments'];
            if ($numberOfUsedArguments > $numberOfAllowedArguments) {
                $this->matches[] = [
                    'restFiles' => $this->matcherDefinitions[$methodName]['restFiles'],
                    'line' => $node->getAttribute('startLine'),
                    'subject' => $methodName,
                    'message' => 'Implementation of dropped interface argument for method "' . $methodName . '()"',
                    'indicator' => static::INDICATOR_WEAK,
                ];
            }
        }

        // Match method call (not static) with number of arguments
        if ($node instanceof MethodCall
            && in_array($node->name->name, array_keys($this->matcherDefinitions), true)
        ) {
            $methodName = $node->name->name;
            $numberOfUsedArguments = 0;
            if (isset($node->args) && is_array($node->args)) {
                $numberOfUsedArguments = count($node->args);
            }
            // @todo: Test for argument unpacking
            $numberOfAllowedArguments = $this->matcherDefinitions[$methodName]['newNumberOfArguments'];
            if ($numberOfUsedArguments > $numberOfAllowedArguments) {
                $this->matches[] = [
                    'restFiles' => $this->matcherDefinitions[$methodName]['restFiles'],
                    'line' => $node->getAttribute('startLine'),
                    'subject' => $methodName,
                    'message' => 'Call to interface method "' . $methodName . '()"',
                    'indicator' => static::INDICATOR_WEAK,
                ];
            }
        }
    }
}
