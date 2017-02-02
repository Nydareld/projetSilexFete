<?php
namespace TheoGuerin\Model;
// use Doctrine\ORM\Mapping as ORM;

use \Datetime;

/**
 * @Entity @Table(name="contact")
 **/
class Contact extends AbstractEntity{
    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @Column(type="string")
     * @var string
     */
    private $pseudo;

    /**
     * @Column(type="string")
     * @var string
     */
    private $email;

    /**
     * @Column(type="datetime")
     * @var datetime
     */
    private $creationDate;

    /**
     * @Column(type="string",length=1000,nullable=true)
     * @var string
     */
    private $comment;

    public function __construct()
    {
        $this->creationDate = new DateTime();
    }

    public static function getFields(){
        return array("id", "pseudo", "email","creationDate","comment");
    }

    public static function getEditableFields(){
        return array("pseudo", "email","comment");
    }

    public static function getRequiredFields(){
        return array("pseudo", "email","comment");
    }

    public static function getIgnoredFields(){
        return array();
    }

    /**
     * Get the value of Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get the value of Pseudo
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set the value of Pseudo
     *
     * @param string pseudo
     *
     * @return self
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get the value of Email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of Email
     *
     * @param string email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of Creation Date
     *
     * @return datetime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set the value of Creation Date
     *
     * @param datetime creationDate
     *
     * @return self
     */
    public function setCreationDate(datetime $creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get the value of Comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of Comment
     *
     * @param string comment
     *
     * @return self
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

}
