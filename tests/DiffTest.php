<?php

namespace tests\test;

use PHPUnit\Framework\TestCase;

use function genDiff\genDiff;

class DiffTest extends TestCase
{
    public function testGenDiff($firstPath, $secondPath, $expected, $style = 'stylish')
    {
        $this->assertEquals($expected, genDiff($firstPath, $secondPath, $style));
    }

    public function simpleFiles()
    {
        $firstJson = 'tests/fixtures/file1.json';
        $secondJson = 'tests/fixtures/file2.json';

        $firstYml = 'tests/fixtures/file1.yml';
        $secondYml = 'tests/fixtures/file2.yml';

        $expected = trim(file_get_contents($this->
        getFixture('result')));

        return [
            [$firstJson, $secondJson, $expected],
            [$firstYml, $secondYml, $expected]
        ];
    }

    public function TreeFiles()
    {
        $firstJson = 'tests/fixtures/file1Tree.json';
        $secondJson = 'tests/fixtures/file2Tree.json';
        $firstYml = 'tests/fixtures/file1Tree.yaml';
        $secondYml = 'tests/fixtures/file2Tree.yaml';

        $expectedStylish = trim(file_get_contents($this->
        getFixture('resultStylish')));

        return [
            [$firstJson, $secondJson, $expected],
            [$firstYml, $secondYml, $expected]
        ];
    }

    public function getFixture($fixtureName)
    {
        $parts = [__DIR__, 'fixtures', $fixtureName];
        return realpath(implode('/', $parts));
    }
}