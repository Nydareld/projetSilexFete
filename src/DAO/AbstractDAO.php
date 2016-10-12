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
        $this->app[conexion]->prepare($sql)->execute();
    }

    public function getAll(){

        $class = $this->className;
        $namespace = "TheoGuerin\Models\\$class";
        $fields = $namespace::getFields();

        $sql = "SELECT * fROM $class";
        $rows = $this->app[conexion]->query($sql);

        $res = array();

        foreach ($rows as $row) {
            $object = new $namespace();
            var_dump($object);
            foreach ($fields as $field) {
                $function = "set".ucfirst($field);
                $object->$function($row[$field]);
            }
            var_dump($object);
            array_push($res,$object);
        }
    }

}
