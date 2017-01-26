<?php
namespace TheoGuerin\DAO;

use Doctrine\ORM\EntityManager;
use TheoGuerin\Service\QuerryParam;

abstract class AbstractDao
{

    private $querryParam;
    private $em;
    protected $className;

    public function __construct(EntityManager $em, QuerryParam $querryParam) {
        $this->em = $em;
        $this->querryParam = $querryParam;
    }

    protected function getEm() {
        return $this->em;
    }

    public function save($object){
        $this->getEm()->persist($object);
        $this->getEm()->flush();
    }
    public function remove($object){
        $this->getEm()->remove($object);
        $this->getEm()->flush();
    }
// findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    public function getAll(){
        $object= $this->getEm()->getRepository($this->className)->findBy(
            $this->querryParam->getFilter(),
            $this->querryParam->getSort(),
            $this->querryParam->getLimit(),
            $this->querryParam->getOffset()
        );

        if ($object === null){
            return array();
        }else{
            return $object;
        }
    }

    public function getOneById($id){
        $object= $this->getEm()->getRepository($this->className)->findOneBy(array('id' => $id));

        return $object;
    }

}
