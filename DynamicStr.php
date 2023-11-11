<?php
/*
 * Plugin Name: Dynamic Strings
 * Description: This plugin created for dynamic strings
 * Version:     1.0
 * Author:      Edgar Khachaturov
 * License:     MIT
 * */
declare(strict_types=1);

if ( !defined('ABSPATH') ) {
    return;
}
include_once 'inc/DynamicStrDB.php';
include_once 'inc/DynamicStrFunctions.php';
include_once 'inc/DynamicStrGlobal.php';
if (!class_exists('DynamicStr')){
    class DynamicStr
    {
        public function initialization(){
            $this->define('DynamicStr', __FILE__);
            $this->hooks();
        }

        public function hooks() : void{
            register_activation_hook(__FILE__, [$this, 'activatedPlugin']);
            add_action('wp_head', static function(){
                echo dnn_('car', 'ru');
            });
        }

        public function activatedPlugin() : void{
            $DynamicStrDB = new DynamicStrDB();
            $DynamicStrDB->activateDB();
        }

        private function define($key, $val){
            if (!defined($key)){
                define($key, $val);
            }
        }
    }
    $DynamicStr = new DynamicStr();
    $DynamicStr->initialization();
}