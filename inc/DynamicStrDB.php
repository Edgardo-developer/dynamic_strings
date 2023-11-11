<?php
if (!class_exists('DynamicStrDB')){
    class DynamicStrDB{
        public static string $tableName = 'dynamicStr';

        /**
         * Description: Get the string from DB
         * @param $string
         * @param $lang
         * @return array
         */
        public static function getStringByLang($string, $lang) : array{
            global $wpdb;
            $tableName = self::getTableName();
            return $wpdb->get_results("SELECT * FROM $tableName WHERE originName = '$string' AND langSlug = '$lang'",
                ARRAY_A);
        }

        /**
         * Description: Set a string
         * @param string $originName
         * @param string $langSlug
         * @param string $translated
         * @param string $groupName
         * @return bool
         */
        public static function setString(string $originName, string $langSlug, string $translated, string $groupName) : bool{
            global $wpdb;
            return $wpdb->insert(self::getTableName(), array(
                'originName'    => $originName,
                'langSlug'    => $langSlug,
                'translated'    => $translated,
                'groupName'    => $groupName,
            ));
        }

        /**
         * Description: Removes the string from the DB
         * @param string $originName
         * @param string $lang
         * @return bool
         */
        public static function removeString(string $originName, string $lang) : bool{
            global $wpdb;
            $deleted = $wpdb->delete(self::getTableName(), array(
                'originName'    => $originName,
                'langSlug'    => $lang,
            ));
            if (is_bool($deleted)) {
                return false;
            }
            return true;
        }

        /**
         * Description: Get strings by group
         * @param string $groupName
         * @param string $lang
         * @return array
         */
        public static function getStringsByGroup(string $groupName, string $lang) : array{
            global $wpdb;
            $tableName = $wpdb->prefix.self::$tableName;
            return $wpdb->get_results("SELECT * FROM $tableName WHERE groupName = '$groupName' AND langSlug = '$lang'",
                ARRAY_A);
        }

        /**
         * Description: Method returns the name of table
         * @return string
         */
        private static function getTableName() : string{
            global $wpdb;
            return $wpdb->prefix.self::$tableName;
        }
    }
}