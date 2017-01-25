<?php
namespace TheoGuerin\Model;
// use Doctrine\ORM\Mapping as ORM;

use \Datetime;

/**
 * @Entity @Table(name="product")
 **/
class Product extends AbstractEntity{
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
     * @Column(type="string",length=10000)
     * @var string
     */
    private $description;

    /**
     * @Column(type="datetime")
     * @var datetime
     */
    private $creationDate;

    /**
     * @Column(type="array")
     * @var array
     */
    private $images = array();

    /**
     * @Column(type="float")
     * @var int
     */
    private $price;

    /**
     * @OneToMany(targetEntity="TheoGuerin\Model\Comment", mappedBy="product")
     */
    private $comments;


    public function __construct()
    {
        $this->creationDate = new DateTime();
    }

    public static function getFields(){
        return array("id", "name", "comments", "description", "creationDate", "images", "price" );
    }

    public static function getEditableFields(){
        return array("name", "description", "images", "price" );
    }

    public static function getRequiredFields(){
        return array("name", "description", "price" );
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
     * Get the value of Comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    public function setComments($comments)
    {
        $this->comments=$comments;
        return $this;
    }

    /**
     * Get the value of Comments
     *
     * @return string
     */
    public function addComments($comment)
    {
        array_push($this->comments, $comment);
        return $this;
    }

    /**
     * Get the value of Description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of Description
     *
     * @param string description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

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
     * Get the value of Images
     *
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set the value of Images
     *
     * @param array images
     *
     * @return self
     */
    public function setImages(array $images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Get the value of price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of Price
     *
     * @param int price
     *
     * @return self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }



}
