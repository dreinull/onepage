<?php

/**
 * Created by PhpStorm.
 * User: jasch
 * Date: 03.10.2016
 * Time: 16:14
 */

namespace Onepage;

class Help {
    public static function createPath() {
        return realpath(implode(DIRECTORY_SEPARATOR, func_get_args()));
    }
    
    public static function getConfig($name) {
        $file = Help::createPath(config_path, $name . '.php');
        if(file_exists($file)) {
            return include($file);
        }
        return false;
    }
}