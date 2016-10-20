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

    protected function buildObject($row){
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

    public function saveObject($object){
        $class = $this->className;
        $namespace = "TheoGuerin\Models\\$class";
        $fields = $namespace::getFields();

        $sql = "
            INSERT INTO $class
            (".implode(',',$fields).")
            values (?".str_repeat(",?",count($fields)-1).")
        ";
        $statment = $this->app['conexion']->prepare($sql);
        $fieldsData = array();

        foreach ($fields as $field) {
            $function = "get".ucfirst($field);
            array_push($fieldsData,$object->$function());
        }
        $statment->execute($fieldsData);
        $lastId = $this->app['conexion']->lastInsertId();

        return $this->getOneById($lastId);

    }

    public function updateObject($object,$id){
        $class = $this->className;
        $namespace = "TheoGuerin\Models\\$class";
        $fields = $namespace::getFields();

        $sql = "
            UPDATE $class
            SET
            ".implode(' = ?, ',$fields)." = ?
            where id = ?
        ";
        $statment = $this->app['conexion']->prepare($sql);
        $fieldsData = array();

        foreach ($fields as $field) {
            $function = "get".ucfirst($field);
            array_push($fieldsData,$object->$function());
        }
        array_push($fieldsData,$id);

        $statment->execute($fieldsData);
        return $this->getOneById($id);

    }
}
