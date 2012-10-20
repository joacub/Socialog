<?php

namespace Socialog\Mapper;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Socialog\Service\AbstractService;

abstract class AbstractDoctrineMapper extends AbstractService
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    protected $entityName;

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return \Doctrine\DBAL\Connection
     */
    public function getDatabase()
    {
        return $this->entityManager->getConnection();
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    public function getRepository()
    {
        return $this->entityManager->getRepository($this->entityName);
    }
}
