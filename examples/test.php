<?php
use TYPO3\CMS\Scanner\Domain\Model\MatcherBundleCollection;
use TYPO3\CMS\Scanner\Matcher;
use TYPO3\CMS\Scanner\ScannerFactory;

require_once __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL ^ E_NOTICE);

$collection = new MatcherBundleCollection(
    new \TYPO3\CMS\Scanner\Domain\Model\MatcherBundle(
        __DIR__ . '/../config/Matcher',
        '../TYPO3.CMS/typo3/sysext/core/Documentation/Changelog',

        Matcher\ArrayDimensionMatcher::class,
        Matcher\ArrayGlobalMatcher::class,
        Matcher\ClassConstantMatcher::class,
        Matcher\ClassNameMatcher::class,
        Matcher\ConstantMatcher::class,
        Matcher\FunctionCallMatcher::class,
        Matcher\InterfaceMethodChangedMatcher::class,
        Matcher\MethodArgumentDroppedMatcher::class,
        Matcher\MethodArgumentDroppedStaticMatcher::class,
        Matcher\MethodArgumentRequiredMatcher::class,
        Matcher\MethodArgumentUnusedMatcher::class,
        Matcher\MethodCallMatcher::class,
        Matcher\MethodCallStaticMatcher::class,
        Matcher\PropertyProtectedMatcher::class,
        Matcher\PropertyPublicMatcher::class
    )
);

$scanner = ScannerFactory::create()
    ->createFor(\PhpParser\ParserFactory::PREFER_PHP7);

// clone news extension into examples directory to test it
// `git clone https://github.com/georgringer/news.git`
$result = $scanner->scanPath(
    __DIR__ . '/news/',
    $collection
);

var_dump($result);