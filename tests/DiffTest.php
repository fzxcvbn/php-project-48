<?php

namespace tests\test;

use PHPUnit\Framework\TestCase;

use function genDiff\genDiff;

class DiffTest extends TestCase
{
    public function testGenDiff($firstPath, $secondPath, $expected)
    {
        $this->assertEquals($expected, genDiff($firstPath, $secondPath));
    }

    public function qwerty()
    {
        $firstJson = 'tests/fixtures/file1.json';
        $secondJson = 'tests/fixtures/file2json';

        $firstYml = 'tests/fixtures/file1.yml';
        $secondYml = 'tests/fixtures/file2.yml';

        $expected = trim(file_get_contents($this->
        getFixtureFullPath('result')));

        return [
            [$firstJson, $secondJson, $expected],
            [$firstYml, $secondYml, $expected]
        ];
    }

    public function getFixturePath($fixtureName)
    {
        $parts = [__DIR__, 'fixtures', $fixtureName];
        return realpath(implode('/', $parts));
    }
}