<?php


/*
 * Load classes
 */
require_once __DIR__ . '/vendor' . '/autoload.php';


/*
 * Load important stuff and connect to database
 */
$boot = new \Onepage\Boot\Start();
$boot->getThisPartyStarted();

new Onepage\Boot\Routes();