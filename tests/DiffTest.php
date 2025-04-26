<?php

namespace tests\DiffTest;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DiffTest extends TestCase
{
    public function testGenDiff()
    {
        $firstJson = 'tests/fixtures/file1Tree.json';
        $secondJson = 'tests/fixtures/file2Tree.json';
        $firstYml = 'tests/fixtures/file1Tree.yml';
        $secondYml = 'tests/fixtures/file2Tree.yml';

        $actual = genDiff($firstJson, $secondJson, 'stylish');
        $expected = file_get_contents('tests/fixtures/resultStylish');
        $this->assertEquals($expected, $actual);

        $actual = genDiff($firstYml, $secondYml, 'stylish');
        $expected = file_get_contents('tests/fixtures/resultStylish');
        $this->assertEquals($expected, $actual);

        $actual = genDiff($firstJson, $secondJson, 'plain');
        $expected = file_get_contents('tests/fixtures/resultPlain');
        $this->assertEquals($expected, $actual);

        $actual = genDiff($firstYml, $secondYml, 'plain');
        $expected = file_get_contents('tests/fixtures/resultPlain');
        $this->assertEquals($expected, $actual);

        $actual = genDiff($firstJson, $secondJson, 'json');
        $expected = file_get_contents('tests/fixtures/resultJson');
        $this->assertEquals($expected, $actual);

        $actual = genDiff($firstYml, $secondYml, 'json');
        $expected = file_get_contents('tests/fixtures/resultJson');
        $this->assertEquals($expected, $actual);
    }
}
