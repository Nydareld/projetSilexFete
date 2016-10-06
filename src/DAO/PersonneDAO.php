<?php

namespace TheoGuerin\DAO;

class PersonneDAO extends AbstractDAO{


    public function __construct($app){
        parent::__construct($app);
        $this->className = "Personne";
    }

}
