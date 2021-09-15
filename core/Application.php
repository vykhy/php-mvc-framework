<?php

namespace app\core;

/**
 * Class application
 * @package app\core
 */
class Application{
    public Router $router;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function run(){
        $this->router->resolve();
    }
}

?>