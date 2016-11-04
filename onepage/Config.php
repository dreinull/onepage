<?php

namespace Onepage;

class Config {
    private static $instance = null;

    private $app;
    private $database;
    private $routes;

    public function __construct() {
        $this->app = (object) include(config_path . DIRECTORY_SEPARATOR .  'app.php');
        $this->database = (object) include(config_path . DIRECTORY_SEPARATOR .  'database.php');
    } 

    public static function getInstance() {
         if (null === self::$instance) {
            self::$instance = new Config();
        }
        
        return self::$instance;
    }

    public static function app($value = null) {
        return self::get('app', $value);
    }

    public static function database($value = null) {
        return self::get('database', $value);
    }

    public static function routes($value = null) {
        return self::get('routes', $value);
    }

    public static function get($option, $value = null) {
        if($value == null) {
            return self::getInstance()->$option;
        }
        return self::getInstance()->$option->$value;
    }


    
}