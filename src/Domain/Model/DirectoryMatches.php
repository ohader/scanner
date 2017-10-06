<?php
namespace TYPO3\CMS\Scanner\Domain\Model;

use TYPO3\CMS\Scanner\Utility;

class DirectoryMatches extends \ArrayObject
{
    private $path;

    public function __construct(string $path, FileMatches ...$fileMatches)
    {
        parent::__construct($fileMatches);
        $this->path = Utility::ensureTrailingDirectorySeparator($path);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    public function countAll(): int
    {
        $counts = array_map(
            function (FileMatches $fileMatches) {
                return $fileMatches->count();
            },
            $this->getArrayCopy()
        );
        return array_sum($counts);
    }
}