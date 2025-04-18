<?php

namespace Parsers;

use Symfony\Component\Yaml\Yaml;

function convertingFile($fileContent, $extension)
{
    switch ($extension) {
        case 'json':
            return json_decode($fileContent);
        case 'yaml':
            return Yaml::parse($fileContent, Yaml::PARSE_OBJECT_FOR_MAP);
        case 'yml':
            return Yaml::parse($fileContent, Yaml::PARSE_OBJECT_FOR_MAP);
    }
}
