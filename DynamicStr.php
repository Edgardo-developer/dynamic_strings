<?php
/*
 * Plugin Name: Dynamic Strings
 * Description: This plugin created for dynamic strings
 * Version:     1.0
 * Author:      Edgar Khachaturov
 * License:     MIT
 * */

if ( !defined('ABSPATH') ) {
    return;
}
include_once('Utilities.php');
include_once('./inc/DynamicStrFunctions.php');
if (!class_exists('DynamicStr')){
    class DynamicStr
    {
        public function initialization(){
            $this->define('DynamicStr', __FILE__);
        }

        public function hooks() : void{
            register_activation_hook(__FILE__, [$this, 'activatedPlugin']);
        }

        public function activatedPlugin() : void{
            global $wpdb;
            $this->createTable($wpdb);
        }

        private function createTable($wpdb) : void{
            $sql = "CREATE TABLE IF NOT EXISTS `".DynamicStrDB::$tableName."` (
                ID INT NOT NULL AUTO_INCREMENT,
                originName VARCHAR(100) NOT NULL,
                langSlug VARCHAR(10) NOT NULL,
                groupName VARCHAR(100) NOT NULL,
                translated VARCHAR(100) NOT NULL,
                PRIMARY KEY (ID)
            )";
            $wpdb->query($sql);

        }

        private function define($key, $val){
            if (!defined($key)){
                define($key, $val);
            }
        }
    }
    $DynamicStr = new DynamicStr();
    $DynamicStr->hooks();
}