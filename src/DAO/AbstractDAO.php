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
        $this->app['conexion']->prepare($sql)->execute();
    }

    public function getAll(){

        $class = $this->className;

        $sql = "SELECT * fROM $class";
        $rows = $this->app['conexion']->query($sql);

        $res = array();

        foreach ($rows as $row) {
            $object = $this->buildObject($row);
            array_push($res,$object);
        }
        return $res;
    }

    public function getOneById($id){

        $class = $this->className;

        $sql = "SELECT * fROM $class where id = ?";
        $statment = $this->app['conexion']->prepare($sql);
        $statment->execute([$id]);

        $row = $statment->fetch();

        return $this->buildObject($row);
    }

    public function buildObject($row){
        $class = $this->className;
        $namespace = "TheoGuerin\Models\\$class";
        $fields = $namespace::getFields();

        $object = new $namespace();

        foreach ($fields as $field) {
            $function = "set".ucfirst($field);
            $object->$function($row[$field]);
        }

        return $object;
    }

}
