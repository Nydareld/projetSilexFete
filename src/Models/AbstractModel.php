<?php

namespace TheoGuerin\Models;

class AbstractModel{

    protected $id;

    public static function getSchema(){
        return "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY";
    }

    public static function getFields(){
        return array("id");
    }

}
