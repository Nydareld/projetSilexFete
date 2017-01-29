<?php
namespace TheoGuerin\DAO;

use TheoGuerin\DAO\AbstractDao;
use Doctrine\ORM\EntityManager;
use TheoGuerin\Service\QuerryParam;

class ImageDao extends AbstractDao{

    public function __construct(EntityManager $em, QuerryParam $querryParam) {
        $this->className = "TheoGuerin\Model\Image";
        parent::__construct($em,$querryParam);
    }

}
