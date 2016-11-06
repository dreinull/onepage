<?php

namespace Onepage;

class Request {
    public static function input($name) {
        if (array_key_exists($name, $_POST)) {
            return $_POST[$name];
        }
        if (array_key_exists($name, $_GET)) {
            return $_GET[$name];
        }
        return null;
    }

    public static function has($name) {
        if (array_key_exists($name, $_POST)) {
            return true;
        }
        if (array_key_exists($name, $_GET)) {
            return true;
        }
        return false;
    }

    public static function all() {
        return array_merge($_GET, $_POST);
    }

    public static function only($names) {
        return array_intersect_key(self::all(), array_flip($names));
    }

    /**
     * Rules can be
     * required, numeric, email
     * @param array $rules
     */

    public static function validate($rules) {
        foreach($rules as $key => $rule) {
            
        }
    }
}