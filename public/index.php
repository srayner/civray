<?php

namespace Civray;

// We would use PSR4 autoloading, but for now we require these files.

require '../src/Route.php';
require '../src/Request.php';
require '../src/Router.php';
require '../src/controller/IndexController.php';
require '../src/controller/UserController.php';

$config = include('../src/config/config.php');
$router = new Router($config);
$request = new Request;

$routeMatch = $router->route($request);
if ($routeMatch) {
    $controllerClass = __NAMESPACE__ . '\\Controller\\' . $routeMatch->controller . 'Controller';
    $action = $routeMatch->action . 'Action';
    $controller = new $controllerClass();
    var_dump($controller);
    $controller->$action();
}