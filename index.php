<?php


/*
 * Load classes
 */
require_once __DIR__ . '/vendor' . '/autoload.php';


/*
 * Load important stuff and connect to database
 */
$boot = new \Onepage\Start();
$boot->getThisPartyStarted();

//var_dump(Onepage\Config::app()->name);

new Onepage\Routes();

//$sections = Onepage\Model::getData();
//Onepage\View::create($sections);
