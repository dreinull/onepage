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

/*function getTemplate($name) {
    if(is_dir(view_path . DIRECTORY_SEPARATOR . $name)) {
        if(file_exists)
    }
}*/