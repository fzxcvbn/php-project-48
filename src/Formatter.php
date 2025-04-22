<?php

namespace Differ\Formatters;

use function Stylish\stylish;
use function Plain\plain;
use function Json\jsonFormat;

function makeFormat(array $tree, string $formatter): string
{
    if ($formatter === 'stylish') {
        return stylish($tree);
    }
    if ($formatter === 'plain') {
        return plain($tree);
    }
    if ($formatter === 'json') {
        return jsonFormat($tree);
    } else {
        throw new \Exception("Invalid formatter. The format should be 'stylish' , 'plain' or 'json'");
    }
}