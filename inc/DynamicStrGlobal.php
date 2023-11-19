<?php

if (!defined('ABSPATH')) {
    exit;
}
$DynamicStrFunctions = new DynamicStrFunctions();
// Get the string by language code
function dnn_($string, $language) : string{
    global $DynamicStrFunctions;
    if (defined('DynamicStr')){
        return $DynamicStrFunctions->getStringByLang($string, strtolower($language));
    }
    return '';
}

// Get strings of the Group
function dnn_g(string $groupName, string $language, bool $associative = true) : array{
    global $DynamicStrFunctions;
    if (defined('DynamicStr')){
     return $DynamicStrFunctions->getStringsByGroup($groupName, strtolower($language), $associative);
    }
    return array();
}

// Set the string
function dnn_s(string $original, string $language, string $translated, string $groupName = 'global') : void{
    global $DynamicStrFunctions;
    if (defined('DynamicStr')){
        $DynamicStrFunctions->setString($original, strtolower($language), $translated, $groupName);
    }
}

// Remove the string
function dnn_r(string $original, string $language) : void{
    global $DynamicStrFunctions;
    if (defined('DynamicStr')){
        $DynamicStrFunctions->removeString($original, strtolower($language));
    }
}

function dnn_langs() : array{
    $directoryPath = __DIR__.'/../assets/images/country_flag';
    $directoryFiles = scandir($directoryPath);
    foreach ($directoryFiles as $directoryFileKey => &$directoryFile){
        if ($directoryFileKey < 2){
            unset($directoryFiles[$directoryFileKey]);
        }
        $fileName = explode('.', $directoryFile);
        $directoryFile = $fileName[0];
    }
    return array_values($directoryFiles);
}