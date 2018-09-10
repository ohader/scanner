<?php
declare(strict_types = 1);
namespace TYPO3\CMS\Scanner\Tests\Unit\Matcher;

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

use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\ParserFactory;
use PHPUnit\Framework\TestCase;
use TYPO3\CMS\Scanner\Matcher\ArrayMatcher;

/**
 * Test case
 */
class ArrayMatcherTest extends TestCase
{
    /**
     * @test
     */
    public function hitsFromFixtureAreFound()
    {
        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
        $fixtureFile = __DIR__ . '/Fixtures/ArrayMatcherFixture.php';
        $statements = $parser->parse(file_get_contents($fixtureFile));

        $traverser = new NodeTraverser();
        $traverser->addVisitor(new NameResolver());

        $configuration = [
            'ctrl/dividers2tabs' => [
                'restFiles' => [
                    'Breaking-62833-Dividers2Tabs.rst',
                ],
            ],
            'ctrl/versioningWS' => [
                'matchOnValues' => [1, 2],
                'restFiles' => [
                    'Breaking-24449-UseMovePlaceholdersAsDefaultInWorkspaces.rst',
                ],
            ],
        ];
        $subject = new ArrayMatcher($configuration);
        $traverser->addVisitor($subject);
        $traverser->traverse($statements);
        $expectedHitLineNumbers = [
            29,
            36,
            44,
            51,
        ];
        $actualHitLineNumbers = [];
        foreach ($subject->getMatches() as $hit) {
            $actualHitLineNumbers[] = $hit['line'];
        }
        $this->assertEquals($expectedHitLineNumbers, $actualHitLineNumbers);
    }
}
