<?php

use Symfony\Component\HttpFoundation\Request;

require_once __DIR__.'/config/config.php';

$app["debug"] = true;


$app->before(function(Request $request){
    if(0 === strpos($request->headers->get('Content-Type'),'application/json')){
        $data = json_decode($request->getContent(),true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

$app["conexion"] = new PDO(
    "mysql:dbname=".
    $app["config"]["db"]["BASE"].";host=".
    $app["config"]["db"]["SERVER"],
    $app["config"]["db"]["USER"],
    $app["config"]["db"]["PASSWD"]
);

$app["dao.Personne"] = function ($app) {
    return new TheoGuerin\DAO\PersonneDAO($app);
};

require_once __DIR__.'/routes.php';
