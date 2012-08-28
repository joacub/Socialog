<?php

namespace Socialog\Mapper;

use Socialog\Entity\User as UserEntity;
use Zend\Db\Sql\Select;

/**
 * User Mapper
 */
class UserMapper extends AbstractDbMapper
{
	protected $tableName = 'users';
	protected $entityPrototype = 'Socialog\Entity\User';

	/**
	 * Retrieve all posts
	 *
	 * @param string $email
	 * @return \Socialog\Entity\User
	 */
	public function findByEmail($email)
	{
        $select = $this
            ->select()
            ->where(array('email' => $email));

        return $this->selectSingle($select);
	}

	/**
	 * @param string $username
	 * @return \Socialog\Entity\User
	 */
	public function findByUsername($username)
	{
        $select = $this
            ->select()
            ->where(array('username' => $username));

        return $this->selectSingle($select);
	}
}
