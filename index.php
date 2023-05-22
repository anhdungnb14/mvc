<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
// print_r($_REQUEST);
session_start();
//require file autoload
require_once __DIR__ . '/autoload/autoload.php';
// định tuyến controllers action dựa vào hệ thống routing build in
$routeInstance = new Router\Route();
require_once __DIR__ . '/Router/web.php';

//dispatchRoute
$routeInstance->dispatchRoute($_SERVER['REQUEST_URI']);
