<?php

namespace TheoGuerin\Service;

class Hydrator{

    public function hydrate(Array $data, $className){
        $entity = new $className();
        $required = $className::getRequiredFields();
        foreach ($className::getEditableFields() as $field) {
            if(isset($data[$field])){
                $required = array_diff($required, array($field));
                $methodeName ="set".ucfirst( $field );
                $entity->$methodeName($data[$field]);
            }
        }
        if(count($required)>0){
            return "missing field(s) : " . implode(",", $required);
        }
        return $entity;
    }

}
