<?php
namespace TheoGuerin\Model;
// use Doctrine\ORM\Mapping as ORM;

use \Datetime;

/**
 * @Entity @Table(name="proposal")
 **/
class Proposal extends AbstractEntity{
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
    private $productName;

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
        return array("id", "productName","pseudo", "comment","creationDate");
    }

    public static function getEditableFields(){
        return array("productName","pseudo", "comment");
    }

    public static function getRequiredFields(){
        return array("productName","pseudo",);
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
     * Get the value of Product Name
     *
     * @return datetime
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Set the value of Product Name
     *
     * @param datetime productName
     *
     * @return self
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;

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
