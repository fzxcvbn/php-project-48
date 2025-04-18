<?php

namespace Json;

function jsonFormat(array $tree): string
{
    return json_encode($tree, JSON_THROW_ON_ERROR);
}
