<?php

namespace Differ\Formatters;

use function Stylish\stylish;
use function Plain\plain;
use function Json\jsonFormat;

function makeFormat(array $tree, string $formatter): string
{
    switch ($formatter) {
        case 'stylish':
            return stylish($tree);
        case 'plain':
            return plain($tree);
        case 'json':
            return jsonFormat($tree);
        default:
            throw new \Exception("Invalid formatter. The format should be 'stylish' , 'plain' or 'json'");
    }
}
