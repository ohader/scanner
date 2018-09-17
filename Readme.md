TYPO3 scanner
=============

Scans code for usage of deprecated and or changed code.

This is a library component that can be used to build tools that scan PHP files for broken or deprecated code.

Tools using this library:
- [TYPO3 CMS v9](https://typo3.org/)
- [standalone TYPO3 scanner](https://github.com/Tuurlijk/typo3scan)

TYPO3 publishes [breaking changes and deprecations since version 7](https://docs.typo3.org/typo3cms/extensions/core/stable/Index.html).

This library uses the [PHP parser](https://github.com/nikic/PHP-Parser) written by [Nikita Popov](https://github.com/nikic). The parser transforms the PHP code from a file into an [Abstract Syntax Tree (AST)](https://github.com/nikic/PHP-Parser/blob/master/doc/component/Walking_the_AST.markdown). This can then be easily analysed using 'Matchers' and accompanying 'Rules'.

## Matchers
Every node visited by the node traverser, will be checked using all Matchers specified in the `\TYPO3\CMS\Scanner\Domain\Model\MatcherBundle`.

Currently we have the followign matchers:

### ArrayDimensionMatcher
Matches arrays like `$GLOBALS['foo']['bar']`
### ArrayGlobalMatcher
Match access to a one dimensional $GLOBAL array
Example `$GLOBALS['TYPO3_DB']`
### ArrayMatcher
Find usages of dropped TCA configuration values and other nested array structures.
You can specify the `matchOnValues` parameter to pass in an array of values to match.
### ClassConstantMatcher
Find usages of class constants.
Test for `Class\Name::THE_CONSTANT`, matches are considered "strong"
### ClassNameMatcher
Find usages of class / interface names which are entirely deprecated or removed
### ClassNamePatternMatcher
Find usages of class / interface names which are entirely deprecated or removed by specifying regex patterns
### ConstantMatcher
Find usages of class constants.
Test for `THE_CONSTANT`, matches are considered "strong"
### FunctionCallMatcher
Find usages of global function calls which were removed / deprecated. This is a strong match.
### GlobalMatcher
Match access to a one dimensional '$GLOBAL' array
Example `$TT`
### InterfaceMethodChangedMatcher
Matches interface method arguments which have been dropped.
This does *not* test if a class implements an interface.
The scanner only looks for:
- Class method names not having specified number of arguments
- Method calls with given method name not having this number of arguments
### MethodAnnotationMatcher
Find usages of method annotations
### MethodArgumentDroppedMatcher
Find usages of method calls which changed signature and dropped arguments,
but are called with more arguments.
This is a "weak" match since we're just testing for method name
but not connected class.
### MethodArgumentDroppedStaticMatcher
Find usages of static method calls which were removed / deprecated.
This is a "strong" match if class name is given and "weak" if not.
### MethodArgumentRequiredMatcher
Find usages of method calls which changed signature and added required arguments.
This is a "weak" match since we're just testing for method name
but not connected class.
### MethodArgumentRequiredStaticMatcher
Find usages of static method calls which gained new mandatory arguments.
This is a "strong" match if class name is given and "weak" if not.
### MethodArgumentUnusedMatcher
Match method usages where arguments "in between" are unused but not given as "null":
`public function foo($arg1, $unsused1 = null, $unused2 = null, $arg4)`
but called with:
`->foo('arg1', 'notNull', null, 'arg4');`
### MethodArgumentUnusedStaticMatcher
Match static method usages where arguments "in between" are unused but not given as "null":
`public function foo($arg1, $unsused1 = null, $unused2 = null, $arg4)`
but called with:
`->foo('arg1', 'notNull', null, 'arg4');`
This is a "strong" match if class name is given and "weak" if not.
### MethodCallMatcher
Find usages of method calls which were removed / deprecated.
This is a "weak" match since we're just testing for method name
but not connected class.
### MethodCallStaticMatcher
Find usages of static method calls which were removed / deprecated.

This match is performed either is case of a direct `foo\bar::aMethod()` call
as "strong" match, or as only `::aMethod()` as "weak" match.

As additional indicator, the number of required, mandatory arguments is
recognized: If calling a static method as `$foo::aMethod($arg1)`, but the
method needs two arguments, this is *not* considered a match. This would
have raised a fatal PHP error anyway and this is nothing we test here.
### PropertyAnnotationMatcher
Find usages of property annotations
### PropertyExistsStaticMatcher
Find usages of properties which have been deprecated or removed.
Useful if abstract classes remove properties.
### PropertyProtectedMatcher
Find usages of properties which have been made protected and are
not called in $this context.
### PropertyPublicMatcher
Find usages of properties which were removed / deprecated.

## Rules
There are rulesets for each matcher in: [config/Matcher](./config/Matcher). Currently there are rules for v7, v8 and v9 of TYPO3.

## Test
When you write a new matcher or extend an existing one, please also write the needed tests.

You can run the tests with: `./.Build/bin/phpunit tests`