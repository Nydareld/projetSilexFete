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
