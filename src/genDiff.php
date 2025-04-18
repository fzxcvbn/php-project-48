<?php

namespace genDiff;

use function Parsers\convertingFile;
use function Stylish\stylish;
use function Plain\plain;
use function Functional\sort;
use function Json\jsonFormat;

function genDiff($firstFile, $secondFile, $formatter = 'stylish')
{
    $extensionFirst = pathinfo($firstFile, PATHINFO_EXTENSION);
    $extensionSecond = pathinfo($secondFile, PATHINFO_EXTENSION);

    $firstFile1 = file_get_contents($firstFile);
    $secondFile2 = file_get_contents($secondFile);

    $conventing1 = convertingFile($firstFile1, $extensionFirst);
    $conventing2 = convertingFile($secondFile2, $extensionSecond);

    $tree = difference($conventing1, $conventing2);
    if ($formatter == 'stylish') {
        return stylish($tree);
    }
    if ($formatter == 'plain') {
        return plain($tree);
    }
    if ($formatter == 'json') {
        return jsonFormat($tree);
    }
}

function difference($conventing1, $conventing2)
{
    $dataFile1 = get_object_vars($conventing1);
    $dataFile2 = get_object_vars($conventing2);
    $mergeKey = array_merge(array_keys($dataFile1), array_keys($dataFile2));
    $sortKey = sort($mergeKey, fn ($left, $right) => strcmp($left, $right));
    $uniqueKey = array_unique($sortKey);
    return array_map(function ($key) use ($dataFile1, $dataFile2) {
        if (!array_key_exists($key, $dataFile1)) {
            return ['key' => $key, 'data2Value' => $dataFile2[$key], 'type' => 'added'];
        } elseif (!array_key_exists($key, $dataFile2)) {
            return ['key' => $key, 'data1Value' => $dataFile1[$key], 'type' => 'removed'];
        }
        if (is_object($dataFile1[$key]) && is_object($dataFile2[$key])) {
            $children = difference($dataFile1[$key], $dataFile2[$key]);
            return ['key' => $key, 'type' => 'parent', 'children' => $children];
        }
        if ($dataFile1[$key] === $dataFile2[$key]) {
            return  ['key' => $key, 'data1Value' => $dataFile1[$key], 'type' => 'unchanged'];
        } else {
            return ['key' => $key, 'data1Value' => $dataFile1[$key], 'data2Value' => $dataFile2[$key], 'type' => 'updated'];
        }
    }, $uniqueKey);
}