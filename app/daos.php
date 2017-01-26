<?php


$app["dao.product"] = function ($app) {
    return new TheoGuerin\DAO\ProductDao($app['orm.em'],$app["querryparam"]);
};

$app["dao.comment"] = function ($app) {
    return new TheoGuerin\DAO\CommentDao($app['orm.em'],$app["querryparam"]);
};

$app["dao.event"] = function ($app) {
    return new TheoGuerin\DAO\EventDao($app['orm.em'],$app["querryparam"]);
};
