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

    public function __construct(){
    }




    /**
     * Get the value of Age
     *
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set the value of Age
     *
     * @param mixed age
     *
     * @return self
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get the value of Nom
     *
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of Nom
     *
     * @param mixed nom
     *
     * @return self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of Prenom
     *
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of Prenom
     *
     * @param mixed prenom
     *
     * @return self
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of Ville
     *
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set the value of Ville
     *
     * @param mixed ville
     *
     * @return self
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get the value of Naissance
     *
     * @return mixed
     */
    public function getNaissance()
    {
        return $this->naissance;
    }

    /**
     * Set the value of Naissance
     *
     * @param mixed naissance
     *
     * @return self
     */
    public function setNaissance($naissance)
    {
        $this->naissance = $naissance;

        return $this;
    }

}
