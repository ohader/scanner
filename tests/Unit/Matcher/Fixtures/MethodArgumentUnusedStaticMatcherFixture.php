<?php
declare(strict_types = 1);
namespace TYPO3\CMS\Scanner\Tests\Unit\Matcher\Fixtures;

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

/**
 * Fixture file
 */
class MethodArgumentUnusedStaticMatcherFixture
{
    public function aMethod()
    {

        // Match:
        $someVar::insertModuleFunction(
            'web_info',
            'Tx_Solr_ModIndex_IndexInspector',
            $GLOBALS['PATH_solr'] . 'ModIndex/IndexInspector.php',
            'LLL:EXT:solr/Resources/Private/Language/Backend.xml:module_indexinspector'
        );
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::insertModuleFunction(
            'web_info',
            'Tx_Solr_ModIndex_IndexInspector',
            $GLOBALS['PATH_solr'] . 'ModIndex/IndexInspector.php',
            'LLL:EXT:solr/Resources/Private/Language/Backend.xml:module_indexinspector'
        );

        // No match: With argument unpacking we don't know how many args are actually given
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::insertModuleFunction(
            ...$args
        );
        // @extensionScannerIgnoreLine
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::insertModuleFunction(
            'web_info',
            'Tx_Solr_ModIndex_IndexInspector',
            $GLOBALS['PATH_solr'] . 'ModIndex/IndexInspector.php',
            'LLL:EXT:solr/Resources/Private/Language/Backend.xml:module_indexinspector'
        );
    }
}
