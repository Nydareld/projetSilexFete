<?php
namespace TheoGuerin\DAO;

use TheoGuerin\DAO\AbstractDao;
use Doctrine\ORM\EntityManager;
use TheoGuerin\Service\QuerryParam;

class ContactDao extends AbstractDao{

    public function __construct(EntityManager $em, QuerryParam $querryParam) {
        $this->className = "TheoGuerin\Model\Contact";
        parent::__construct($em,$querryParam);
    }

}
