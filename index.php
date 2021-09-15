<?php

echo 'Hello world';

$app = new Application();

$app->router->get('/', function(){
    return 'Hello';
});

$app->run();
?>