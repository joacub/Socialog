<?php

namespace Socialog\Mapper;

use Socialog\Entity\User;

/**
 * User Mapper
 */
class UserMapper extends AbstractDoctrineMapper
{
    protected $entityName = 'Socialog\Entity\User';

    /**
     * Retrieve all posts
     *
     * @param string $email
     * @return User
     */
    public function findByEmail($email)
    {
        return $this->getRepository()->findOneByEmail($email);
    }

    /**
     * @param string $username
     * @return User
     */
    public function findByUsername($username)
    {
        return $this->getRepository()->findOneByUsername($username);
    }
}
