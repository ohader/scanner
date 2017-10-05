<?php
namespace TYPO3\CMS\Scanner\Visitor;

use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use TYPO3\CMS\Scanner\CodeScannerInterface;
use TYPO3\CMS\Scanner\Domain\Model\MatcherBundleCollection;
use TYPO3\CMS\Scanner\Matcher\MatcherFactory;

class TraverserFactory
{
    private $matcherFactory;

    public function __construct(MatcherFactory $matcherFactory)
    {
        $this->matcherFactory = $matcherFactory;
    }

    public function createTraverser(CodeScannerInterface ...$matchers): NodeTraverser
    {
        $traverser = $this->buildNodeTraverser();
        // add all matchers to traverser
        foreach ($matchers as $matcher) {
            $traverser->addVisitor($matcher);
        }
        return $traverser;
    }

    /**
     * @param MatcherBundleCollection $collection
     * @return CodeScannerInterface[]
     */
    public function createMatchers(MatcherBundleCollection $collection): array
    {
        return $this->matcherFactory->createAll(
            $collection->getConfiguration()
        );
    }

    private function buildNodeTraverser(): NodeTraverser
    {
        $traverser = new NodeTraverser();
        // The built in NameResolver translates class names shortened with
        // 'use' to fully qualified class names at all places. Incredibly
        // useful for us and added as first visitor.
        $traverser->addVisitor(new NameResolver());
        // Understand makeInstance('My\\Package\\Foo\\Bar') as full-qualified
        // class name in first argument
        $traverser->addVisitor(new GeneratorClassesResolver());
        // count ignored lines, effective code lines, ...
        $traverser->addVisitor(new CodeStatistics());

        return $traverser;
    }
}