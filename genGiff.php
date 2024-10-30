<?php
$autoloadPath1 = __DIR__ . '/../../../autoload.php';
$autoloadPath2 = __DIR__ . '/../vendor/autoload.php';

if (file_exists($autoloadPath1)) {
    require_once $autoloadPath1;
} else {
    require_once $autoloadPath2;
}

function genGiff($firstFile, $secondFile)
{
    $first = json_decode($firstFile, true);
    $second = json_decode($secondFile, true);

    print_r(json_encode(array_intersect($array1, $array2)));
}
