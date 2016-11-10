<?php

function getConfig($name) {
        $file = createPath(config_path, $name . '.php');
        if(file_exists($file)) {
            return include($file);
        }
        return false;
    }

function createPath() {
    return realpath(implode(DIRECTORY_SEPARATOR, func_get_args()));
}

function getComponent() {
    $path[] = getHomeUrl();
    $path[] = 'components';
    $path = array_merge($path, func_get_args());
    
    return implode('/', $path);
}

function component() {
    echo call_user_func_array('getComponent', func_get_args());
}

function self() {
    //echo ;
    echo getSelf();
}

function getSelf() {
    return htmlspecialchars($_SERVER["REQUEST_URI"]); 
}

function getHomeUrl() {
    return str_replace('/index.php', '', htmlspecialchars($_SERVER["PHP_SELF"]));
}


function route($name, $params = []) {
    $route = \Onepage\Boot\Config::routes($name);

    foreach($params as $key => $value) {
        $route = str_replace('{'.$key.'}', $value, $route);
    }
    return getHomeUrl() . $route;
}

function tq($name) {
    return '`' . $name . '`';
}

function sq($name) {
    return "'" . $name . "'";
}

function ec($value) {
    echo htmlspecialchars($value);
}