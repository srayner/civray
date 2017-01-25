<?php

namespace Civray;

class Request
{
    public $method;
    public $uri;
    
    public function __construct()
    {
        $this->method = filter_var($_SERVER['REQUEST_METHOD'], FILTER_SANITIZE_STRING);
        $this->uri = '/' . substr(filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL), 1);
    }
}
