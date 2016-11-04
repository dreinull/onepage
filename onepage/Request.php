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

    public static function all() {
        return array_merge($_GET, $_POST);
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