<?php

namespace Stylish;

function stylish(array $tree): string
{
    return generate($tree);
}

function generate(array $tree, int $depth = 0): string
{
    $indents = createIndentation($depth, 4);
    $result = array_map(function ($item) use ($depth, $indents) {
        $deep = $depth + 1;
        switch ($item['type']) {
            case 'parent':
                return $indents . "    " . $item['key'] . ": " . generate($item['children'], $deep) . "\n";
            case 'added':
                $valueAdded = stringing([$item['data2Value']], $deep);
                return $indents . "  + " . $item['key'] . ": " . $valueAdded . "\n";
            case 'removed':
                $valueRemoved = stringing([$item['data1Value']], $deep);
                return $indents . "  - " . $item['key'] . ": " . $valueRemoved . "\n";
            case 'updated':
                $valueRemoved = stringing([$item['data1Value']], $deep);
                $valueAdd = stringing([$item['data2Value']], $deep);
                $itemRemoved = $item['key'] . ": " . $valueRemoved . "\n";
                $itemAdd = $item['key'] . ": " . $valueAdd;
                return $indents . "  - " . $itemRemoved . $indents . "  + " . $itemAdd . "\n";
            case 'unchanged':
                $valueUnchanged = stringing([$item['data1Value']], $deep);
                return $indents . "    " . $item['key'] . ": " . $valueUnchanged . "\n";
        }
    }, $tree);
    return '{' . "\n" . implode("", $result) . $indents . '}';
}

function createIndentation(int $depth, int $numberOfIndents): string
{
    return str_repeat(" ", $depth * $numberOfIndents);
}

function stringing(array $dataValue, int $depth): string
{
    $value = $dataValue[0];
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    } elseif (is_null($value)) {
        return 'null';
    } elseif (!is_object($value)) {
        return (string) $value;
    }
    $indents = createIndentation($depth, 4);
    $text = array_map(function ($key, $item) use ($depth, $indents) {
        $deep = $depth + 1;
        if (is_object($item)) {
            $valueOfItem = stringing([$item], $deep);
        } else {
            $valueOfItem = $item;
        }
        return $indents . "    " . "$key: " . $valueOfItem . "\n";
    }, array_keys(get_object_vars($value)), get_object_vars($value));
    return '{' . "\n" . implode("", $text) . $indents . '}';
}
