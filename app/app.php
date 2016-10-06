<?php

require_once __DIR__.'/config.php';

$app["debug"] = true;

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
