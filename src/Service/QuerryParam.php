<?php

namespace TheoGuerin\Service;

use Symfony\Component\HttpFoundation\Request;

/**
 * parse les parametres GET pour filter, limiter, trier et paginer les requettes
 *
 * default :
 *      filtre : []
 *      trie : []
 *      limite : 100
 *      pagination : 0
 *
 * exemple de:
 *      filtre : http://fete.lc/api/product?filter=[{"property":"price","value":"18"}]
 *      trie : http://fete.lc/api/product?sort=[{"property":"id","direction":"DESC"}]
 *      limite : http://fete.lc/api/product?limit=3
 *      pagination : http://fete.lc/api/product?page=2
 *      tout : http://fete.lc/api/product?sort=[{"property":"id","direction":"DESC"}]&limit=3&page=0&filter=[{"property":"price","value":"18"}]
 */
class QuerryParam{

    private $req;

    private $filter;
    private $sort;
    private $limit;
    private $offset;

    public function __construct(Request $req)
    {
        $this->req = $req;

        $this->buildLimit();
        $this->buildOffset();
        $this->buildFilter();
        $this->buildSort();

    }

    /**
     * parse $_GET pour créer les filtres
     * @method buildFilter
     */
    protected function buildFilter(){
        $this->filter = array();
        $filters = $this->req->query->get('filter') ? json_decode($this->req->query->get('filter')) : array();
        foreach ($filters as $filter) {
            $this->filter[$filter->property] = $filter->value;
        }
    }

    /**
     * parse $_GET pour créer les trie
     * @method buildSort
     */
    protected function buildSort(){
        $this->sort = array();
        $sorts = $this->req->query->get('sort') ? json_decode($this->req->query->get('sort')) : array();
        foreach ($sorts as $sort) {
            $this->sort[$sort->property] = $sort->direction;
        }
    }

    /**
     * parse $_GET pour créer la limite
     * @method buildLimit
     */
    protected function buildLimit(){
        $this->limit = $this->req->query->get('limit') ? $this->req->query->get('limit') : 100;
    }

    /**
     * parse $_GET pour créer la l'offset (pagination)
     * @method buildOffset
     */
    protected function buildOffset(){
        $this->offset = $this->limit * ( $this->req->query->get('page') ? $this->req->query->get('page') : 0 );
    }

    /**
     * Get the value of Page
     *
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set the value of Page
     *
     * @param mixed page
     *
     * @return self
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get the value of Limit
     *
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * Set the value of Limit
     *
     * @param mixed limit
     *
     * @return self
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }


    /**
     * Get the value of Filter
     *
     * @return mixed
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * Set the value of Filter
     *
     * @param mixed filter
     *
     * @return self
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * Get the value of Sort
     *
     * @return mixed
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Set the value of Sort
     *
     * @param mixed sort
     *
     * @return self
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Get the value of Offset
     *
     * @return mixed
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * Set the value of Offset
     *
     * @param mixed offset
     *
     * @return self
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;

        return $this;
    }

}
