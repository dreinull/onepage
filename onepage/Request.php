<?php

namespace Onepage;

class Request {
    public static function input($name) {
        if (array_key_exists($name, $_POST)) {
            return $_POST[$name];
        }
    }
    
    public static function all() {
        return $_POST;
    }
}