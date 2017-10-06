<?php
namespace TYPO3\CMS\Scanner;

class Utility
{
    public static function ensureTrailingDirectorySeparator(string $path): string
    {
        return rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    }

    public static function removeTrailingDirectorySeparator(string $path): string
    {
        return rtrim($path, DIRECTORY_SEPARATOR);
    }
}