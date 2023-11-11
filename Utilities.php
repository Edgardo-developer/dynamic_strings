<?php

// Get the string by language code
function dnn_($string, $lang) : string{
    if (defined('DynamicStr')){
     return DynamicStrFunctions::getStringByLang($string, strtolower($lang));
    }
    return '';
}

// Get strings of the Group
function dnn_g(string $groupName, string $lang, bool $associative = true) : array{
    if (defined('DynamicStr')){
     return DynamicStrFunctions::getStringsByGroup($groupName, strtolower($lang), $associative);
    }
    return array();
}

// Set the string
function dnn_s(string $original, string $lang, string $translated, string $groupName = 'global') : void{
    if (defined('DynamicStr')){
     DynamicStrFunctions::setString($original, strtolower($lang), $translated, $groupName);
    }
}

// Remove the string
function dnn_r(string $original, string $lang) : void{
    if (defined('DynamicStr')){
     DynamicStrFunctions::removeString($original, strtolower($lang));
    }
}