<?php

namespace Civray;

class Router
{
    protected $routes = array();
    
    public function __construct($config = array())
    {
        if (isset($config['router']['routes'])) {
            foreach ($config['router']['routes'] as $route) {
                $this->addRoute($route[0], $route[1], $route[2], $route[3]);
            }
        }
    }
    
    public function addRoute($method, $pattern, $controller, $action)
    {
        $this->routes[] = new Route($method, $pattern, $controller, $action);
    }
    
    public function route($request)
    {
        foreach($this->routes as $route) {
            $matchMethod = (($route->method == $request->method) or ($route->method == '*')); 
            $matchPattern = $this->match($route->pattern, $request->uri);
            if ($matchMethod && $matchPattern) {
                return $route;
            }
        }
    }
    
    protected function match($pattern, $url)
    {
        $regex = "\"^$pattern$\"";
        return preg_match($regex, $url);
    }
}

