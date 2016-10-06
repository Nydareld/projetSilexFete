<?php

namespace TheoGuerin\Controllers;

use Silex\Application;

class DataBaseController{
    public function createBaseAction(Application $app){
        foreach ($app["config"]["daoList"] as $DAO => $class) {
            $app[$DAO]->createTable();
        }
        return "Database crée";
    }
}
