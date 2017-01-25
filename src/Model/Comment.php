<?php
namespace TheoGuerin\Model;
// use Doctrine\ORM\Mapping as ORM;

use \Datetime;

/**
 * @Entity @Table(name="comment")
 **/
class Comment extends AbstractEntity{
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
     * @Column(type="datetime")
     * @var datetime
     */
    private $creationDate;

    /**
     * @Column(type="string",length=1000)
     * @var string
     */
    private $text;

    /**
     * @ManyToOne(targetEntity="TheoGuerin\Model\Product", inversedBy="comments")
     */
    private $product;


    public function __construct()
    {
        $this->creationDate = new DateTime();
    }

    public static function getFields(){
        return array("id", "product","pseudo", "creationDate", "text");
    }

    public static function getEditableFields(){
        return array("pseudo", "text");
    }

    public static function getRequiredFields(){
        return array("pseudo", "text");
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
     * Get the value of Text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of Text
     *
     * @param string text
     *
     * @return self
     */
    public function setText($text)
    {
        $this->text = $text;

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
