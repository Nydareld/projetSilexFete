<?php
namespace TheoGuerin\Model;
// use Doctrine\ORM\Mapping as ORM;

use \Datetime;

/**
 * @Entity @Table(name="location")
 **/
class Location extends AbstractEntity{
    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @Column(type="string")
     * @var string
     */
    private $loueur;

    /**
     * @OneToOne(targetEntity="TheoGuerin\Model\Event",cascade={"persist"})
     */
    private $debutLocation;

    /**
     * @OneToOne(targetEntity="TheoGuerin\Model\Event",cascade={"persist"})
     */
    private $finLocation;

    /**
     * @ManyToOne(targetEntity="TheoGuerin\Model\Product", inversedBy="locations")
     */
    private $product;

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
        return array("id", "loueur", "debutLocation", "finLocation", "creationDate");
    }

    public static function getEditableFields(){
        return array("loueur", "debutLocation", "finLocation");
    }

    public static function getRequiredFields(){
        return array("loueur", "debutLocation", "finLocation" );
    }

    public static function getIgnoredFields(){
        return array("product");
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
     * Get the value of Loueur
     *
     * @return string
     */
    public function getLoueur()
    {
        return $this->loueur;
    }

    /**
     * Set the value of Loueur
     *
     * @param string loueur
     *
     * @return self
     */
    public function setLoueur($loueur)
    {
        $this->loueur = $loueur;

        return $this;
    }

    /**
     * Get the value of debutLocation
     *
     * @return date
     */
    public function getDebutLocation()
    {
        return $this->debutLocation;
    }

    /**
     * Set the value of debutLocation
     *
     * @param date debutLocation
     *
     * @return self
     */
    public function setDebutLocation($debutLocation)
    {
        $this->debutLocation = $debutLocation;

        return $this;
    }


    /**
     * Get the value of finLocation
     *
     * @return date
     */
    public function getFinLocation()
    {
        return $this->finLocation;
    }

    /**
     * Set the value of finLocation
     *
     * @param date finLocation
     *
     * @return self
     */
    public function setFinLocation($finLocation)
    {
        $this->finLocation = $finLocation;

        return $this;
    }

    /**
     * Get the value of Product
     *
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set the value of Product
     *
     * @param Product product
     *
     * @return self
     */
    public function setProduct($product)
    {
        $this->product = $product;
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
