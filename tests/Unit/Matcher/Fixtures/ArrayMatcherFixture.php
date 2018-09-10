<?php
declare(strict_types=1);
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
class ArrayMatcherFixture
{
    public function aMethod()
    {
        // Match
        $TCA['blip'] = [
            'ctrl' => [
                'delete' => 'deleted',
                'dividers2tabs' => TRUE,
            ]
        ];

        $someVar = [
            'ctrl' => [
                'delete' => 'deleted',
                'dividers2tabs' => TRUE,
            ]
        ];

        $someVar = [
            'oneMoreThing' => [
                'ctrl' => [
                    'delete' => 'deleted',
                    'dividers2tabs' => TRUE,
                ]
            ]
        ];

        $fieldsTca = [
            'ctrl' => [
                'versioningWS' => 2,
                'delete' => 'deleted',
            ]
        ];

        // No match
        $TCA['blipme'] = [
            'controllah!' => [
                'delete' => 'deleted',
                'dividers2tabs' => TRUE,
            ]
        ];

        $fieldsTca = [
            'ctrl' => [
                'versioningWS' => TRUE,
                'delete' => 'deleted',
            ]
        ];

        return [
            'ctrlollah!' => [
                'delete' => 'deleted',
                'dividers2tabs' => TRUE,
            ]
        ];
    }
}
