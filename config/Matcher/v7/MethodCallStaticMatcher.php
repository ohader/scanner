<?php
return [
    // Removed methods
    'TYPO3\CMS\Backend\RecordList\AbstractRecordList::writeBottom' => [
        'numberOfMandatoryArguments' => 0,
        'maximumNumberOfArguments' => 0,
        'restFiles' => [
            'Breaking-59659-DeprecatedCodeRemovalInBackendSysext.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Sprite\SpriteGenerator::setOmmitSpriteNameInIconName' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 1,
        'restFiles' => [
            'Breaking-59659-DeprecatedCodeRemovalInBackendSysext.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Template\DocumentTemplate::isCMlayers' => [
        'numberOfMandatoryArguments' => 0,
        'maximumNumberOfArguments' => 0,
        'restFiles' => [
            'Breaking-59659-DeprecatedCodeRemovalInBackendSysext.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Template\DocumentTemplate::getFileheader' => [
        'numberOfMandatoryArguments' => 3,
        'maximumNumberOfArguments' => 3,
        'restFiles' => [
            'Breaking-59659-DeprecatedCodeRemovalInBackendSysext.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Utility\BackendUtility::displayWarningMessages' => [
        'numberOfMandatoryArguments' => 0,
        'maximumNumberOfArguments' => 0,
        'restFiles' => [
            'Breaking-59659-DeprecatedCodeRemovalInBackendSysext.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Utility\IconUtility::getIconImage' => [
        'numberOfMandatoryArguments' => 3,
        'maximumNumberOfArguments' => 5,
        'restFiles' => [
            'Breaking-59659-DeprecatedCodeRemovalInBackendSysext.rst',
        ],
    ],
    'TYPO3\CMS\Backend\View\PageLayoutView::getSelectedBackendLayoutUid' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 1,
        'restFiles' => [
            'Breaking-59659-DeprecatedCodeRemovalInBackendSysext.rst',
        ],
    ],
    'TYPO3\CMS\Backend\ClickMenu\ClickMenu::menuItemsForClickMenu' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 1,
        'restFiles' => [
            'Breaking-59659-DeprecatedCodeRemovalInBackendSysext.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\GeneralUtility::formatSize' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 2,
        'restFiles' => [
            'Breaking-60152-formatSizeAdheresLocale.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\MailUtility::mail' => [
        'numberOfMandatoryArguments' => 3,
        'maximumNumberOfArguments' => 5,
        'restFiles' => [
            'Breaking-61783-RemoveDeprecatedMailFunctionality.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\GeneralUtility::plainMailEncoded' => [
        'numberOfMandatoryArguments' => 3,
        'maximumNumberOfArguments' => 7,
        'restFiles' => [
            'Breaking-61783-RemoveDeprecatedMailFunctionality.rst',
        ],
    ],
    'TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController::getCompressedTCarray' => [
        'numberOfMandatoryArguments' => 3,
        'maximumNumberOfArguments' => 7,
        'restFiles' => [
            'Breaking-61785-FrontendTcaFunctionsRemoved.rst',
        ],
    ],
    'TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController::includeTCA' => [
        'numberOfMandatoryArguments' => 0,
        'maximumNumberOfArguments' => 1,
        'restFiles' => [
            'Breaking-61785-FrontendTcaFunctionsRemoved.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA' => [
        'numberOfMandatoryArguments' => 0,
        'maximumNumberOfArguments' => 1,
        'restFiles' => [
            'Breaking-61785-LoadTcaFunctionRemoved.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLocalconfWritable' => [
        'numberOfMandatoryArguments' => 0,
        'maximumNumberOfArguments' => 0,
        'restFiles' => [
            'Breaking-61802-IsLocalconfWritableFunctionRemoved.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\PhpOptionsUtility::isSafeModeEnabled' => [
        'numberOfMandatoryArguments' => 0,
        'maximumNumberOfArguments' => 0,
        'restFiles' => [
            'Breaking-61820-PhpOptionsUtilityDeprecatedFunctionsRemoved.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\PhpOptionsUtility::isMagicQuotesGpcEnabled' => [
        'numberOfMandatoryArguments' => 0,
        'maximumNumberOfArguments' => 0,
        'restFiles' => [
            'Breaking-61820-PhpOptionsUtilityDeprecatedFunctionsRemoved.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\GeneralUtility::int_from_ver' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 1,
        'restFiles' => [
            'Breaking-61860-RemoveIntFromVerFunction.rst',
        ],
    ],
    'TYPO3\CMS\Frontend\Utility\EidUtility::connectDB' => [
        'numberOfMandatoryArguments' => 0,
        'maximumNumberOfArguments' => 0,
        'restFiles' => [
            'Breaking-61863-ConnectDbFunctionRemoved.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\GeneralUtility::array_merge_recursive_overrule' => [
        'numberOfMandatoryArguments' => 2,
        'maximumNumberOfArguments' => 5,
        'restFiles' => [
            'Breaking-62416-DeprecatedCodeRemovalInCoreSysext.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\GeneralUtility::htmlspecialchars_decode' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 1,
        'restFiles' => [
            'Breaking-62416-DeprecatedCodeRemovalInCoreSysext.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getRequiredExtensionListArray' => [
        'numberOfMandatoryArguments' => 0,
        'maximumNumberOfArguments' => 0,
        'restFiles' => [
            'Breaking-62416-DeprecatedCodeRemovalInCoreSysext.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\ExtensionManagementUtility::writeNewExtensionList' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 1,
        'restFiles' => [
            'Breaking-62416-DeprecatedCodeRemovalInCoreSysext.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\PhpOptionsUtility::isSqlSafeModeEnabled' => [
        'numberOfMandatoryArguments' => 0,
        'maximumNumberOfArguments' => 0,
        'restFiles' => [
            'Breaking-62416-DeprecatedCodeRemovalInCoreSysext.rst',
        ],
    ],
    'TYPO3\CMS\Core\Core\ClassLoader::getAliasForClassName' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 1,
        'restFiles' => [
            'Breaking-62416-DeprecatedCodeRemovalInCoreSysext.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\GeneralUtility::quoted_printable' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 2,
        'restFiles' => [
            'Deprecation-62794-DeprecateOldMailMethodsInGeneralUtility.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\GeneralUtility::encodeHeader' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 3,
        'restFiles' => [
            'Deprecation-62794-DeprecateOldMailMethodsInGeneralUtility.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\GeneralUtility::substUrlsInPlainText' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 3,
        'restFiles' => [
            'Deprecation-62794-DeprecateOldMailMethodsInGeneralUtility.rst',
        ],
    ],
];
