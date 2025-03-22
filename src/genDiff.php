<?php

namespace genDiff;

use function Parsers\convertingFile;

function genDiff($firstFile, $secondFile)
{
    $extensionFirst = pathinfo($firstFile, PATHINFO_EXTENSION);
    $extensionSecond = pathinfo($secondFile, PATHINFO_EXTENSION);

    $firstFile1 = file_get_contents($firstFile);
    $secondFile2 = file_get_contents($secondFile);

    $conventing1 = convertingFile($firstFile1, $extensionFirst);
    $conventing2 = convertingFile($secondFile2, $extensionSecond);

    $first = get_object_vars($conventing1);
    $second = get_object_vars($conventing2);

    $keys = array_unique(array_merge(array_keys($first), array_keys($second)));
    sort($keys);
    $result = [];

    array_map(function ($key) use ($first, $second, &$result) {
        $value1Exists = array_key_exists($key, $first);
        $value2Exists = array_key_exists($key, $second);

        if ($value1Exists && $value2Exists) {
            if ($first[$key] === $second[$key]) {
                $result[$key] = $first[$key];
            } else {
                $result['- ' . $key] = $first[$key];
                $result['+ ' . $key] = $second[$key];
            }
        } else if ($value1Exists) {
            $result['- ' . $key] = $first[$key];
        } else if ($value2Exists) {
            $result['+ ' . $key] = $second[$key];
        }
    }, $keys);

    return json_encode($result);
}