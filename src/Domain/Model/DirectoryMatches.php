<?php
namespace TYPO3\CMS\Scanner\Domain\Model;

class DirectoryMatches extends \ArrayObject
{
    private $path;

    public function __construct(string $path, FileMatches ...$fileMatches)
    {
        parent::__construct($fileMatches);
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }
}