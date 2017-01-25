<?php
namespace TheoGuerin\DAO;

use TheoGuerin\DAO\AbstractDao;
use Doctrine\ORM\EntityManager;
use Zrtcommunity\Domain\News;

class CommentDao extends AbstractDao{

    public function __construct(EntityManager $em) {
        $this->className = "TheoGuerin\Model\Comment";
        parent::__construct($em);
    }

}
