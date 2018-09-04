<?php
return [
    // removed arguments
    'TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName' => [
        'maximumNumberOfArguments' => 1,
        'restFiles' => [
            '8.0/Breaking-73516-GeneralUtilitygetFileAbsFileNameAllowsForTypo3MaindirSpecificPaths.rst',
            '8.0/Deprecation-73516-VariousGeneralUtilityMethods.rst',
        ],
    ],
    'TYPO3\CMS\Recycler\Utility\RecyclerUtility::getRecordPath' => [
        'maximumNumberOfArguments' => 1,
        'restFiles' => [
            '8.4/Deprecation-75637-DeprecateOptionalParametersOfRecyclerUtilitygetRecordPath.rst',
        ],
    ],
];
