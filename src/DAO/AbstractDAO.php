<?php

namespace TheoGuerin\DAO;

abstract class AbstractDAO{

    protected $className;
    protected $app;

    public function __construct($app){
        $this->app = $app;
    }

    public function createTable(){
        $class = $this->className;
        $namespace = "TheoGuerin\Models\\$class";

        $fields = $namespace::getSchema();
        $sql = "CREATE TABLE IF NOT EXISTS $this->className ($fields)";
        echo "$sql";
        $this->app[conexion]->prepare($sql)->execute();
    }


}
