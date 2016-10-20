<?php
/**
 * Created by PhpStorm.
 * User: jasch
 * Date: 03.10.2016
 * Time: 14:17
 */
 
return [
    'driver' => 'sqlite',
    'database' => \Onepage\Help::createPath(database_path, 'database.sqlite'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
];