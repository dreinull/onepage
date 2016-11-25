<?php

/**
 * Returns a config file as an array
 * @param $name of config filee without .php
 * @return array|bool
 */
function getConfig($name) {
    $file = createPath(config_path, $name . '.php');
    if(file_exists($file)) {
        return include($file);
    }
    return false;
}

/**
 * Creates a path of given arguments
 * @return string or false if no exists
 */
function createPath() {
    return realpath(implode(DIRECTORY_SEPARATOR, func_get_args()));
}

/**
 * Returns Url to to files in component folder
 * @return string
 */
function getComponent() {
    $path[] = getHomeUrl();
    $path[] = 'components';
    $path = array_merge($path, func_get_args());
    
    return implode('/', $path);
}

/**
 * Echoes Url to to files in component folder
 */
function component() {
    echo call_user_func_array('getComponent', func_get_args());
}

function self() {
    echo getSelf();
}

function getSelf() {
    return htmlspecialchars($_SERVER["REQUEST_URI"]); 
}

/**
 * Returns URL to home
 * @return mixed
 */
function getHomeUrl() {
    return str_replace('/index.php', '', htmlspecialchars($_SERVER["PHP_SELF"]));
}

/**
 * Echoes URL to home
 */
function homeUrl() {
    $url = getHomeUrl();
    ec($url );
    //return str_replace('/index.php', '', htmlspecialchars($_SERVER["PHP_SELF"]));
}

/**
 * Returns route to $name with parameters
 * @param $name
 * @param array $params
 * @return string
 */
function route($name, $params = []) {
    $route = \Onepage\Boot\Config::routes($name);

    foreach($params as $key => $value) {
        $route = str_replace('{'.$key.'}', $value, $route);
    }
    return getHomeUrl() . $route;
}

/**
 * Echoes a route to $name with parameters
 * @param $name
 * @param array $params
 */
function ecRoute($name, $params = []) {
    $route = route($name, $params);
    ec($route);
}

/**
 * Wraps a string into table quotes
 * @param $name
 * @return string
 */
function tq($name) {
    return '`' . $name . '`';
}

/**
 * Wraps a string into quotes
 * @param $name
 * @return string
 */
function sq($name) {
    return "'" . $name . "'";
}

/**
 * Returns filtered string if exist
 * @param $value
 * @return string
 */
function ecGet(&$value) {
    return isset($value) ? htmlspecialchars($value) : '';
}

/**
 * Echoes filtered string if exist
 * @param $value
 */
function ec(&$value) {
    echo ecGet($value);
}

/**
 * Returns value from array if exist
 * @param $array
 * @param $key
 * @return null|string
 */
function getFromArray($key, $array) {
    if(is_array($key)) {
        if(count($key) == 1) {
            return getFromArray($key[0], $array);
        } elseif(array_key_exists($level = array_shift($key), $array)) {
            return getFromArray($key, $array[$level]);
        }
    } elseif(array_key_exists($key, $array)) {
        return ecGet($array[$key]);
    }
    return null;
}

/**
 * List alle the sections available
 * @return array
 */
function getAllSections() {
    $sections = [];
    foreach(scandir(section_path) as $folder) {
        // We only need the directorys
        if($folder == '.' OR $folder == '..' OR !is_dir(createPath(section_path, $folder))) { continue; }
        $sections[] = new \Onepage\Section($folder);
    }
    return $sections;
}

/**
 * Redirects to URL
 * @param $url
 * @param bool $permanent
 */
function redirect($url, $permanent = false) {
    header('Location: ' . $url, true, $permanent ? 301 : 302);
    exit();
}

function redirectRoute($name, $values = []) {
    redirect(route($name, $values));
}

function sectionContent($section) {
    return array_merge($section->content, ['id' => $section->id]);
}

function getImageUrl($filename = NULL) {
    return getComponent('img', $filename);
}