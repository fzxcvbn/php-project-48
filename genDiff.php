<?php

namespace genDiff;

function genDiff($firstFile, $secondFile)
{
    $firstFile = file_get_contents($firstFile);
    $secondFile = file_get_contents($secondFile);
    $first = json_decode($firstFile, true);
    $second = json_decode($secondFile, true);

    $result = [];

    $qwerty1 = array_map(function($user1) {
        $qwerty2 = array_map(function($user2) {
            if($user1 == $user2) {
                $result[] = $user1;
            }
            if ((array_keys($user1) == array_keys($user2)) && (array_values($user1) != array_values($user2))) {
                $result[] = "-{$user1}";
                $result[] = "+{$user2}";
            }
            if ($user1 != $user2) {
                $result[] = "-{$user1}";
                $result[] = "+{$user2}";
            }
            return $result;
        }, $second);
        return $result;
    }, $first);

    $resultResult = json_encode($result);
    return $resultResult;
}
