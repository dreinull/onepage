<?php

namespace Onepage;

class Config {
    private static $instance = null;
    private $config; 

    public function __construct() {
        //$this->config = (object) include(config_path . '/database.php');
        $this->config = new \stdClass();
        $this->config->app = (object) include(config_path . DIRECTORY_SEPARATOR .  'app.php');
        $this->config->database = (object) include(config_path . DIRECTORY_SEPARATOR .  'database.php');
    } 

    public static function getInstance() {
         if (null === self::$instance) {
            self::$instance = new Config();
        }
        
        return self::$instance;
    }

    public static function app($value = null) {
        if($value == null) {
            return self::getInstance()->config->app;
        }
        return self::getInstance()->config->app->$value;
    }

    public static function database() {
        return $this->config->database;
    }


    
}