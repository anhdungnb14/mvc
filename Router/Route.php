<?php

namespace Router;
class Route
{
    private $routes = [];

    public function addRoute($path, $routeInfo)
    {
        $this->routes[$path] = $routeInfo;
    }

    public function dispatchRoute($pathCurrent)
    {
        foreach ($this->routes as $path => $routeCurrent) {
            if (strpos($pathCurrent, '?') !== false) {
                $pathCurrent = strstr($pathCurrent, '?', true);
            }
            if ($path === $pathCurrent) {
                $controller = $routeCurrent['controller'];
                $action = $routeCurrent['action'];
                //tao instance
                $instanceController = new $controller();
                $instanceController->$action();
            }
        }
    }
}
