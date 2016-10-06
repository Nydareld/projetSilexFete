<?php

namespace TheoGuerin\Models;

class Personne extends AbstractModel{

    protected $age;
    protected $nom;
    protected $prenom;
    protected $ville;
    protected $naissance;

    public static function getSchema(){
        return parent::getSchema().",
            age INT,
            nom VARCHAR(20) NOT NULL,
            prenom VARCHAR(20) NOT NULL,
            ville VARCHAR(20),
            naissance DATE
        ";
    }

    public static function getFields(){
        return array_merge( parent::getFields(), array("age","nom","prenom","ville","naissance") );
    }

    public function __construct($nom,$prenom){
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

}
