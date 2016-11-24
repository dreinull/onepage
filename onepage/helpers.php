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

function ecGet(&$value) {
    return isset($value) ? htmlspecialchars($value) : '';
}

function ec(&$value) {
    echo ecGet($value);
}

function getFromArray($array, $key) {
    if(array_key_exists($key, $array)) {
        return ecGet($array[$key]);
    }
    return null;
}

function getAllSections() {
    $sections = [];
    foreach(scandir(section_path) as $folder) {
        // We only need the directorys
        if($folder == '.' OR $folder == '..' OR !is_dir(createPath(section_path, $folder))) { continue; }
        $sections[] = new \Onepage\Section($folder);
    }
    return $sections;
}

function redirect($url, $permanent = false) {
    header('Location: ' . $url, true, $permanent ? 301 : 302);
    exit();
}