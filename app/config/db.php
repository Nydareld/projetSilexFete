<?php

$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => $parameters["DB_SERVER"],
    'dbname'   => $parameters["DB_BASE"],
    'user'     => $parameters["DB_USER"],
    'password' => $parameters["DB_PASSWD"],
);
