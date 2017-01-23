<?php


$app["dao.product"] = function ($app) {
    return new TheoGuerin\DAO\ProductDao($app['orm.em']);
};
