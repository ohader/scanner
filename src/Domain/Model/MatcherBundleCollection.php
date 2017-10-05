<?php
namespace TYPO3\CMS\Scanner\Domain\Model;

class MatcherBundleCollection extends \ArrayObject
{
    public function __construct(MatcherBundle ...$bundles)
    {
        parent::__construct($bundles);
    }

    public function getConfiguration(): array
    {
        $matcherBundleConfiguration = array_map(
            function (MatcherBundle $bundle) {
                return $bundle->getConfiguration();
            },
            $this->getArrayCopy()
        );

        return array_merge(...$matcherBundleConfiguration);
    }
}