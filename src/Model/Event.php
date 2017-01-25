<?php
namespace TheoGuerin\Model;
// use Doctrine\ORM\Mapping as ORM;

use \Datetime;

/**
 * @Entity @Table(name="event")
 **/
class Event extends AbstractEntity{
    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @Column(type="string")
     * @var string
     */
    private $name;

    /**
     * @Column(type="datetime")
     * @var datetime
     */
    private $date;

    /**
     * @Column(type="datetime")
     * @var datetime
     */
    private $creationDate;


    public function __construct()
    {
        $this->creationDate = new DateTime();
    }

    public static function getFields(){
        return array("id", "name", "date", "creationDate");
    }

    public static function getEditableFields(){
        return array("name", "date",);
    }

    public static function getRequiredFields(){
        return array("name", "date");
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
     * Get the value of Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of Name
     *
     * @param string name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of Date
     *
     * @return datetime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of Date
     *
     * @param string name
     *
     * @return self
     */
    public function setDate($date)
    {
        $this->date = $date;

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


}
