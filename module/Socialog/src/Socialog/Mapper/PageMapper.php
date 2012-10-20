<?php

namespace Socialog\Mapper;

use Socialog\Entity\Page as PageEntity;
use Zend\Db\Sql\Select;

/**
 * Page PMapper
 */
class PageMapper extends AbstractDoctrineMapper
{
    protected $entityName = 'Socialog\Entity\Page';

    /**
     * Retrieve all posts
     *
     * @return array
     */
    public function findAllPages()
    {
        return $this->getRepository()->findAll();
    }

    /**
     * Find a post by ID
     *
     * @param  integer               $id
     * @return \Socialog\Entity\Page
     */
    public function findById($id)
    {
        return $this->getRepository()->find($id);
    }

    /**
     * @param \Socialog\Entity\Page $page
     */
    public function save(PageEntity $page)
    {
       $this->getEntityManager()->persist($page);
       $this->getEntityManager()->flush($page);
    }
}
