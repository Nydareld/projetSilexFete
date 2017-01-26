<?php
namespace TheoGuerin\DAO;

use TheoGuerin\DAO\AbstractDao;
use Doctrine\ORM\EntityManager;
use Zrtcommunity\Domain\News;

class EventDao extends AbstractDao{

    public function __construct(EntityManager $em, QuerryParam $querryParam) {
        $this->className = "TheoGuerin\Model\Event";
        parent::__construct($em,$querryParam);
    }

}
