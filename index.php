<?php

require_once __DIR__."/vendor/autoload.php";

$app = new Silex\Application();
$app["debug"] = true;

$app["baseRoute"] = '';

$app->get("/",function(){
    return "toto";
});

$app->get("/hello/{name}",function($name){
    return "salut $name";
});

$app->run();
