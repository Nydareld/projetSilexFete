<?php
namespace TheoGuerin\DAO;

use TheoGuerin\DAO\AbstractDao;
use Doctrine\ORM\EntityManager;
use Zrtcommunity\Domain\News;

class ProductDao extends AbstractDao{

    public function __construct(EntityManager $em) {
        $this->className = "TheoGuerin\Model\Product";
        parent::__construct($em);
    }

}
