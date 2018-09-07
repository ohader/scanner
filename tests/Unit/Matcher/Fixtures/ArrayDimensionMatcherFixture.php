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
class ArrayDimensionMatcherFixture
{
    public function aMethod()
    {
        // Match
        $foo['maxSessionDataSize'];
        $foo['bar']['maxSessionDataSize'];
        $GLOBALS['TBE_MODULES_EXT']['xMOD_alt_clickmenu']['extendCMclasses']['path'];
        $GLOBALS['TBE_STYLES']['styleschemes'];

        // No match
        $GLOBALS['TBE_MODULES_EXT']['xMOD_alt_clickmenu']['some_other_key']['path'];
        $GLOBALS['foo']['styleschemes'];
        $GLOBALS['styleschemes'];
        $foo['foo'];
        $foo[$maxSessionDataSize];
        $foo->maxSessionDataSize;
        $foo::maxSessionDataSize;
        // @extensionScannerIgnoreLine
        $foo['maxSessionDataSize'];
    }
}
