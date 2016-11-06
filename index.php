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

new Onepage\Routes();