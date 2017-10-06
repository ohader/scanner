<?php
namespace TYPO3\CMS\Scanner\Domain\Model;

class IndicatorFilterService
{
    /**
     * Filters matches of a directory by given indicators.
     *
     * @param DirectoryMatches $directoryMatches
     * @param string[] ...$indicators
     * @return DirectoryMatches
     */
    public function filterDirectoryMatches(
        DirectoryMatches $directoryMatches,
        string ...$indicators
    ): DirectoryMatches
    {
        $results = array_map(
            function (FileMatches $fileMatches) use ($indicators) {
                return $this->filterFileMatches(
                    $fileMatches,
                    $indicators
                );
            },
            $directoryMatches->getArrayCopy()
        );
        $results = array_filter(
            $results,
            function (FileMatches $fileMatches) {
                return $fileMatches->count() > 0;
            }
        );
        return new DirectoryMatches(
            $directoryMatches->getPath(),
            ...$results
        );
    }

    /**
     * Filters matches of a file by given indicators.
     *
     * @param FileMatches $fileMatches
     * @param string[] ...$indicators
     * @return FileMatches
     */
    public function filterFileMatches(
        FileMatches $fileMatches,
        string ...$indicators
    ): FileMatches
    {
        $results = array_filter(
            $fileMatches->getArrayCopy(),
            function (Match $match) use ($indicators) {
                return in_array($match->getIndicator(), $indicators);
            }
        );
        return new FileMatches(
            $fileMatches->getPath(),
            ...$results
        );
    }
}