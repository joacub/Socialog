<?php

namespace Socialog\Mapper;

use Socialog\Entity\Page as PageEntity;

/**
 * Page Mapper
 */
class PageMapper extends AbstractDoctrineMapper
{
    /**
     * @var string
     */
    protected $entityName = 'Socialog\Entity\Page';

    /**
     * Retrieve all pages
     *
     * @return array
     */
    public function findAllPages()
    {
        return $this->getRepository()->findAll();
    }

    /**
     * Find a page by ID
     *
     * @param  integer $id
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
        $this->triggerEvent('save', array(
            'page' => $page
        ));

        $this->getEntityManager()->persist($page);
        $this->getEntityManager()->flush($page);
    }
}
