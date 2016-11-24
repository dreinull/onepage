<?php

namespace Onepage;

use Illuminate\Database\Capsule\Manager as Capsule;

class User extends \ptejada\uFlex\User {
    private static $instance = null;

    public function __construct() {
        parent::__construct();
        $this->config = getConfig('user');
        $this->config->database->pdo = Capsule::connection()->getPdo();
        $this->start();
    }
    
    public static function get() {
         if (null === self::$instance) {
            self::$instance = new User();
        }
        return self::$instance;
    }

    public static function check() {
        return self::get()->isSigned();
    }

    public static function access() {
        if(self::check() === false) {
            redirect(route('login'));
            //Or if you do not want a redirect, just ...
            //die('No way, bitch!');
        }
    }

    public static function guest() {
        if(self::check() === true) {
            redirect(route('admin'));
        }
    } 
}