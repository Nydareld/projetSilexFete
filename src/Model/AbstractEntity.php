<?php

namespace TheoGuerin\Model;

use \JsonSerializable;

abstract class AbstractEntity implements JsonSerializable{

    public function jsonSerialize(){
        $res = array();
        foreach (array_diff($this->getFields(),$this->getIgnoredFields()) as $field) {
            $getter = "get".ucfirst( $field );
            $res[$field] = $this->$getter();
        }
        return $res;
    }

    public static function getIgnoredFields(){
        return array();
    }

    abstract public static function getFields();

    abstract public static function getEditableFields();

    abstract public static function getRequiredFields();

}
