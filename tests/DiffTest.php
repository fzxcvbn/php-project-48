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
        $secondJson = 'tests/fixtures/file2.json';

        $expected = trim(file_get_contents($this->getFixturePath('result')));

        return [
            [$firstJson, $secondJson, $expected],
        ];
    }

    public function getFixturePath($fixtureName)
    {
        $parts = [__DIR__, 'fixtures', $fixtureName];
        return realpath(implode('/', $parts));
    }
}