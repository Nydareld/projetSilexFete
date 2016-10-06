<?php

$app["config"] = array(
    "db" => array(
        'USER' => "guerin",
        'PASSWD' => "azerqsdf",
        'SERVER' => "servinfo-db",
        'BASE' => "dbguerin"
    ),
    "daoList" => array(
        'dao.Personne' => 'TheoGuerin\DAO\PersonneDAO'
    )
) ;
