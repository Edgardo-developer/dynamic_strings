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
            add_action('admin_menu', [$this, 'DyStrMenu']);
            add_action('admin_enqueue_scripts', [$this, 'DyStrResources']);
            add_action('check_lang', [$this, 'checkLanguageExists']);
        }

        public function checkLanguageExists($langCode){
            if (!file_exists('/assets/images/country_flag/'.$langCode.'.svg')){
                return '';
            }
            return $langCode;
        }

        public function DyStrResources() : void{
            wp_enqueue_style('dystr', plugins_url('dynamic-strings/assets/css/styles.css'));
        }

        public function DyStrMenu(){
            add_menu_page('Dynamic Strings', 'Dynamic Strings', 'edit_others_posts',
            'dystr', static function(){
                require_once('inc/DynamicStrAdminPage.php');
            }, 'dashicons-editor-insertmore');
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