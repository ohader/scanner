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
    'TYPO3\CMS\Backend\Utility\BackendUtility::helpTextIcon' => [
        'numberOfMandatoryArguments' => 3,
        'maximumNumberOfArguments' => 4,
        'restFiles' => [
            'Deprecation-62864-HelpTextIcon.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Utility\BackendUtility::implodeTSParams' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 2,
        'restFiles' => [
            'Deprecation-46523-BackendUtilityImplodeTSParams.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Utility\BackendUtility::getThumbNail' => [
        'numberOfMandatoryArguments' => 2,
        'maximumNumberOfArguments' => 4,
        'restFiles' => [
            'Deprecation-64068-ThumbnailView.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\DebugUtility::debugRows' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 3,
        'restFiles' => [
            'Deprecation-65956-DebugUtilityDebugRows.rst',
        ],
    ],
    'TYPO3\CMS\Core\Imaging\GraphicalFunctions::pngToGifByImagemagick' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 1,
        'restFiles' => [
            'Deprecation-66906-FunctionalityPngToGifConversion.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Utility\BackendUtility::getFileIcon' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 1,
        'restFiles' => [
            'Breaking-67654-RemoveGLOBALSFILEICONSFunctionality.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Utility\BackendUtility::RTEgetObj' => [
        'numberOfMandatoryArguments' => 0,
        'maximumNumberOfArguments' => 0,
        'restFiles' => [
            'Breaking-67811-RteApi.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Utility\BackendUtility::countVersionsOfRecordsOnPage' => [
        'numberOfMandatoryArguments' => 2,
        'maximumNumberOfArguments' => 2,
        'restFiles' => [
            'Deprecation-50349-ReduceSQLQueriesOfPageTreeInWorkspaces.rst',
        ],
    ],
    'TYPO3\CMS\Core\Resource\ResourceCompressor::compressCssPregCallback' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 1,
        'restFiles' => [
            'Deprecation-63974-CssCompressorCallbackAndCompressCssString.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Utility\IconUtility::getIcon' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 3,
        'restFiles' => [
            'Deprecation-67506-DeprecateIconUtilitygetIcon.rst',
            'Deprecation-69057-DeprecateIconUtilityAndMoveMethodsIntoIconFactory.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\GeneralUtility::modifyHTMLColor' => [
        'numberOfMandatoryArguments' => 3,
        'maximumNumberOfArguments' => 3,
        'restFiles' => [
            'Deprecation-68098-GeneralUtilityMethods.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\GeneralUtility::modifyHTMLColorAll' => [
        'numberOfMandatoryArguments' => 2,
        'maximumNumberOfArguments' => 2,
        'restFiles' => [
            'Deprecation-68098-GeneralUtilityMethods.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\GeneralUtility::isBrokenEmailEnvironment' => [
        'numberOfMandatoryArguments' => 0,
        'maximumNumberOfArguments' => 0,
        'restFiles' => [
            'Deprecation-68098-GeneralUtilityMethods.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\GeneralUtility::normalizeMailAddress' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 1,
        'restFiles' => [
            'Deprecation-68098-GeneralUtilityMethods.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\GeneralUtility::formatForTextarea' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 1,
        'restFiles' => [
            'Deprecation-68098-GeneralUtilityMethods.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\GeneralUtility::getThisUrl' => [
        'numberOfMandatoryArguments' => 0,
        'maximumNumberOfArguments' => 0,
        'restFiles' => [
            'Deprecation-68098-GeneralUtilityMethods.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\GeneralUtility::cleanOutputBuffers' => [
        'numberOfMandatoryArguments' => 0,
        'maximumNumberOfArguments' => 0,
        'restFiles' => [
            'Deprecation-68098-GeneralUtilityMethods.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\GeneralUtility::readLLfile' => [
        'numberOfMandatoryArguments' => 2,
        'maximumNumberOfArguments' => 4,
        'restFiles' => [
            'Deprecation-68122-GeneralUtilityReadLLfile.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Toolbar\Enumeration\InformationStatus::mapStatusToInt' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 1,
        'restFiles' => [
            'Breaking-69224-FixWrongUsageOfEnumerationsInInformationStatusmapStatusToInt.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\GeneralUtility::addSlashesOnArray' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 1,
        'restFiles' => [
            'Deprecation-68128-GeneralUtilitySlash-relatedMethods.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\GeneralUtility::stripSlashesOnArray' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 1,
        'restFiles' => [
            'Deprecation-68128-GeneralUtilitySlash-relatedMethods.rst',
        ],
    ],
    'TYPO3\CMS\Core\Utility\GeneralUtility::slashArray' => [
        'numberOfMandatoryArguments' => 2,
        'maximumNumberOfArguments' => 2,
        'restFiles' => [
            'Deprecation-68128-GeneralUtilitySlash-relatedMethods.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Utility\IconUtility::skinImg' => [
        'numberOfMandatoryArguments' => 2,
        'maximumNumberOfArguments' => 4,
        'restFiles' => [
            'Deprecation-69057-DeprecateIconUtilityAndMoveMethodsIntoIconFactory.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIcon' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 3,
        'restFiles' => [
            'Deprecation-69057-DeprecateIconUtilityAndMoveMethodsIntoIconFactory.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIconForFile' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 2,
        'restFiles' => [
            'Deprecation-69057-DeprecateIconUtilityAndMoveMethodsIntoIconFactory.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIconForRecord' => [
        'numberOfMandatoryArguments' => 2,
        'maximumNumberOfArguments' => 3,
        'restFiles' => [
            'Deprecation-69057-DeprecateIconUtilityAndMoveMethodsIntoIconFactory.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIconForResource' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 3,
        'restFiles' => [
            'Deprecation-69057-DeprecateIconUtilityAndMoveMethodsIntoIconFactory.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIconClasses' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 1,
        'restFiles' => [
            'Deprecation-69057-DeprecateIconUtilityAndMoveMethodsIntoIconFactory.rst',
        ],
    ],
    'TYPO3\CMS\Core\Html\HtmlParser::getSubpart' => [
        'numberOfMandatoryArguments' => 2,
        'maximumNumberOfArguments' => 2,
        'restFiles' => [
            'Deprecation-69262-MoveMarkerSubstitutionFunctionalityToOwnClass.rst',
        ],
    ],
    'TYPO3\CMS\Core\Html\HtmlParser::substituteSubpart' => [
        'numberOfMandatoryArguments' => 3,
        'maximumNumberOfArguments' => 5,
        'restFiles' => [
            'Deprecation-69262-MoveMarkerSubstitutionFunctionalityToOwnClass.rst',
        ],
    ],
    'TYPO3\CMS\Core\Html\HtmlParser::substituteSubpartArray' => [
        'numberOfMandatoryArguments' => 2,
        'maximumNumberOfArguments' => 2,
        'restFiles' => [
            'Deprecation-69262-MoveMarkerSubstitutionFunctionalityToOwnClass.rst',
        ],
    ],
    'TYPO3\CMS\Core\Html\HtmlParser::substituteMarker' => [
        'numberOfMandatoryArguments' => 3,
        'maximumNumberOfArguments' => 3,
        'restFiles' => [
            'Deprecation-69262-MoveMarkerSubstitutionFunctionalityToOwnClass.rst',
        ],
    ],
    'TYPO3\CMS\Core\Html\HtmlParser::substituteMarkerArray' => [
        'numberOfMandatoryArguments' => 2,
        'maximumNumberOfArguments' => 5,
        'restFiles' => [
            'Deprecation-69262-MoveMarkerSubstitutionFunctionalityToOwnClass.rst',
        ],
    ],
    'TYPO3\CMS\Core\Html\HtmlParser::substituteMarkerAndSubpartArrayRecursive' => [
        'numberOfMandatoryArguments' => 2,
        'maximumNumberOfArguments' => 5,
        'restFiles' => [
            'Deprecation-69262-MoveMarkerSubstitutionFunctionalityToOwnClass.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Utility\BackendUtility::getPathType_web_nonweb' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 1,
        'restFiles' => [
            'Deprecation-69269-DeprecateBackendUtilitygetPathType_web_nonweb.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Utility\BackendUtility::getUrlToken' => [
        'numberOfMandatoryArguments' => 0,
        'maximumNumberOfArguments' => 2,
        'restFiles' => [
            'Deprecation-69562-DeprecateHelperMethodsForRedundantCSRFProtection.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Utility\BackendUtility::getExcludeFields' => [
        'numberOfMandatoryArguments' => 0,
        'maximumNumberOfArguments' => 0,
        'restFiles' => [
            'Deprecation-69568-VariousFormEngineRelatedMethods.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Utility\BackendUtility::getExplicitAuthFieldValues' => [
        'numberOfMandatoryArguments' => 0,
        'maximumNumberOfArguments' => 0,
        'restFiles' => [
            'Deprecation-69568-VariousFormEngineRelatedMethods.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Utility\BackendUtility::getSystemLanguages' => [
        'numberOfMandatoryArguments' => 0,
        'maximumNumberOfArguments' => 0,
        'restFiles' => [
            'Deprecation-69568-VariousFormEngineRelatedMethods.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Utility\BackendUtility::getRegisteredFlexForms' => [
        'numberOfMandatoryArguments' => 0,
        'maximumNumberOfArguments' => 1,
        'restFiles' => [
            'Deprecation-69568-VariousFormEngineRelatedMethods.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Utility\BackendUtility::exec_foreign_table_where_query' => [
        'numberOfMandatoryArguments' => 1,
        'maximumNumberOfArguments' => 4,
        'restFiles' => [
            'Deprecation-69568-VariousFormEngineRelatedMethods.rst',
        ],
    ],
    'TYPO3\CMS\Backend\Utility\BackendUtility::replaceMarkersInWhereClause' => [
        'numberOfMandatoryArguments' => 2,
        'maximumNumberOfArguments' => 4,
        'restFiles' => [
            'Deprecation-69568-VariousFormEngineRelatedMethods.rst',
        ],
    ],
];
