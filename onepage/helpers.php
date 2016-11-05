<?php

function theTitle() {
    echo Onepage\Config::app('name');
}

function theDescription() {
    echo Onepage\Config::app('description');
}

function show($section, $field) {
    if($field == 'head') {
        echo $section->head;
    } elseif($field == 'body') {
        echo $section->body;
    } elseif(isset($section->content->$field)) {
        echo $section->content->$field->value;
    }
}

function createPath() {
    return realpath(implode(DIRECTORY_SEPARATOR, func_get_args()));
}

function self() {
    //echo str_replace('/index.php', '', htmlspecialchars($_SERVER["PHP_SELF"]));
    echo htmlspecialchars($_SERVER["REQUEST_URI"]);
}

function route($name, $params = []) {
    $route = \Onepage\Config::routes($name);
    foreach($params as $key => $value) {
        $route = str_replace('{'.$key.'}', $value, $route);
    }
    return $route;
}