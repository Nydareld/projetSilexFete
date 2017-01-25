<?php
namespace TheoGuerin\DAO;
use Doctrine\ORM\EntityManager;
abstract class AbstractDao
{

    private $em;
    protected $className;

    public function __construct(EntityManager $em) {
        $this->em = $em;
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

    public function getAll(){
        $object= $this->getEm()->getRepository($this->className)->findAll();
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
