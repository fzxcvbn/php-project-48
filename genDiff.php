<?php

namespace genDiff;

function genDiff($firstFile, $secondFile)
{
    $firstFile1 = file_get_contents($firstFile);
    $secondFile2 = file_get_contents($secondFile);
    $first = json_decode($firstFile1, true);
    $second = json_decode($secondFile2 , true);


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
