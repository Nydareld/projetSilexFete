<?php
namespace TheoGuerin\DAO;

use TheoGuerin\DAO\AbstractDao;
use Doctrine\ORM\EntityManager;
use TheoGuerin\Service\QuerryParam;

class ProductDao extends AbstractDao{

    public function __construct(EntityManager $em, QuerryParam $querryParam) {
        $this->className = "TheoGuerin\Model\Product";
        parent::__construct($em,$querryParam);
    }

}
