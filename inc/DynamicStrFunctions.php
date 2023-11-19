<?php

if (!defined('ABSPATH')) {
    exit;
}
class DynamicStrFunctions{
    public function getStringByLang(string $string, string $lang) : string{
        if (apply_filters('check_lang', $lang)){
            $strings = DynamicStrDB::getStringByLang($string, $lang);
            if (!empty($strings)){
                return self::beautyRow($strings[0]);
            }
        }
        return self::notFound();
    }

    public function removeString(string $original, string $lang) : bool{
        if (apply_filters('check_lang', $lang)){
            return DynamicStrDB::removeString($original, $lang);
        }
        return false;
    }

    public function setString(string $originName, string $langSlug, string $translated, string $groupName) : bool{
        if (apply_filters('check_lang', $langSlug)){
            return DynamicStrDB::setString($originName, $langSlug, $translated, $groupName);
        }
        return false;
    }

    public function getStringsByGroup($groupName, $lang, bool $associative = true) : array{
        if (!apply_filters('check_lang', $lang)){
            return [];
        }
        $strings = DynamicStrDB::getStringsByGroup($groupName, $lang);
        if (!empty($strings)){
            $arr = [];
            foreach ($strings as $string){
                if ($associative){
                    $arr[$string['originName']] = $string['translated'];
                }else{
                    $arr[] = $string['translated'];
                }
            }
            return $arr;
        }
        return array(self::notFound());
    }

    /*
     * Description: Method works, when does not find the rows
     */
    private static function notFound() : string{
        return 'Not Found';
    }

    /**
     * @param array $row
     * @return string
     */
    private static function beautyRow(array $row) : string{
        return $row['translated'] ?? self::notFound();
    }
}
