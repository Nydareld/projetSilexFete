<?php

namespace TheoGuerin\Models;

use JsonSerializable;

class AbstractModel implements JsonSerializable {

    protected $id;

    public static function getSchema(){
        return "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY";
    }

    public static function getFields(){
        return array("id");
    }

    public function JsonSerialize(){
        $res = array('id' => $this->getId() );
        foreach ($this->getFields() as $field) {
            $function = "get".ucfirst($field);
            $res[$field] = $this->$function();
        }
        return $res;
    }

    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param mixed id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

}
