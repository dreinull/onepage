<?php

namespace Onepage;

class Config {
    private static $instance = null;

    private $app;
    private $database;
    private $routes;
    private $sections;

    public function __construct() {
        $this->app = include(config_path . DIRECTORY_SEPARATOR .  'app.php');
        $this->database = include(config_path . DIRECTORY_SEPARATOR .  'database.php');
    } 

    public static function getInstance() {
         if (null === self::$instance) {
            self::$instance = new Config();
        }
        
        return self::$instance;
    }

    public static function app($key = null) {
        return self::get('app', $key);
    }

    public static function database($key = null) {
        return self::get('database', $key);
    }

    public static function setRoutes($routes) {
        self::set($routes, 'routes');
    }
    
    public static function routes($key = null) {
        return self::get('routes', $key);
    }

    public static function set($value, $option, $key = null) {
        if($key == null) {
            self::getInstance()->$option = $value;
        } else {
            self::getInstance()->$option[$key] = $value;
        }
    }
    
    public static function get($option, $key = null) {
        if($key == null) {
            return self::getInstance()->$option;
        }
        $option = self::getInstance()->$option;
        return $option[$key];
    }

}