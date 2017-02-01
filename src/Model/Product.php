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
    * @Column(type="string",length=200)
    * @var string
    */
    private $caption;

    /**
     * @Column(type="string",length=10000,nullable=true)
     * @var string
     */
    private $description;

    /**
     * @Column(type="datetime")
     * @var datetime
     */
    private $creationDate;

    /**
     * @ManyToMany(targetEntity="TheoGuerin\Model\Image")
     * @JoinTable(name="product_images",
     *      joinColumns={@JoinColumn(name="product_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="image_id", referencedColumnName="id")}
     *      )
     */
    private $images;

    /**
     * @Column(type="float")
     * @var int
     */
    private $price;

    /**
     * @OneToMany(targetEntity="TheoGuerin\Model\Comment", mappedBy="product")
     */
    private $comments;

    /**
     * @OneToMany(targetEntity="TheoGuerin\Model\Location", mappedBy="product")
     */
    private $locations;

    public function __construct()
    {
        $this->creationDate = new DateTime();
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public static function getFields(){
        return array("id", "name", "comments", "caption", "description", "creationDate", "images", "price" );
    }

    public static function getEditableFields(){
        return array("name", "caption", "description", "price" );
    }

    public static function getRequiredFields(){
        return array("name", "caption", "price" );
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
     * Get the value of Locations
     *
     * @return string
     */
    public function getLocations()
    {
        return $this->locations;
    }

    public function setLocations($locations)
    {
        $this->locations=$locations;
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
     * Set the value of Images
     *
     * @param array images
     *
     * @return self
     */
    public function addImage($image)
    {
        $this->images->add($image);

        return $this;
    }

    public function clearImages(){
        $this->images->clear();
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

    public function jsonSerialize(){
        $res = parent::jsonSerialize();
        if($this->getComments()){
            $res['comments'] = $this->getComments()->getValues();
        }else {
            $res['comments'] = array();
        }
        $res['comments_count'] = count($res['comments']);
        if($this->getLocations()){
            $res['locations'] = $this->getLocations()->getValues();
        }else {
            $res['locations'] = array();
        }
        $res['locations_count'] = count($res['locations']);
        if($this->getImages()){
            $res['images'] = $this->getImages()->toArray();
        }else {
            $res['images'] = array();
        }
        $res['images_count'] = count($res['images']);
        return $res;
    }




    /**
     * Get the value of Caption
     *
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Set the value of Caption
     *
     * @param string caption
     *
     * @return self
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;

        return $this;
    }

}
