<?php
//thêm định tuyến với path là gì sẽ load ra controller, action tương ứng
if (!empty($routeInstance)) {
    $routeInstance->addRoute('/product', ['controller' => 'App\Http\Controllers\HomeController', 'action' => 'index']);
    $routeInstance->addRoute('/product/add', ['controller' => 'App\Http\Controllers\HomeController', 'action' => 'create']);
    $routeInstance->addRoute('/product/store', ['controller' => 'App\Http\Controllers\HomeController', 'action' => 'store']);
    $routeInstance->addRoute('/product/edit', ['controller' => 'App\Http\Controllers\HomeController', 'action' => 'edit']);
    $routeInstance->addRoute('/product/update', ['controller' => 'App\Http\Controllers\HomeController', 'action' => 'update']);
    $routeInstance->addRoute('/product/delete', ['controller' => 'App\Http\Controllers\HomeController', 'action' => 'delete']);
    $routeInstance->addRoute('/new', ['controller' => 'App\Http\Controllers\NewController', 'action' => 'index']);
}
