<?php
return [
    // removed arguments
    'TYPO3\CMS\Core\Database\DatabaseConnection->sql_connect' => [
        'maximumNumberOfArguments' => 0,
        'restFiles' => [
            'Breaking-62416-DeprecatedCodeRemovalInCoreSysext.rst',
            'Breaking-62670-DeprecatedCodeRemovalInMultipleSysexts.rst',
        ],
    ],
    'TYPO3\CMS\Core\Database\DatabaseConnection->sql_select_db' => [
        'maximumNumberOfArguments' => 0,
        'restFiles' => [
            'Breaking-62416-DeprecatedCodeRemovalInCoreSysext.rst',
            'Breaking-62670-DeprecatedCodeRemovalInMultipleSysexts.rst',
        ],
    ],
    'TYPO3\CMS\Core\Database\DatabaseConnection->connectDB' => [
        'maximumNumberOfArguments' => 0,
        'restFiles' => [
            'Breaking-62416-DeprecatedCodeRemovalInCoreSysext.rst',
        ],
    ],
];
