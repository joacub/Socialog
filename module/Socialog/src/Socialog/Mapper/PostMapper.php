<?php

namespace Socialog\Mapper;

use Socialog\Entity\Post as PostEntity;
use Zend\Db\Sql\Select;

/**
 * Post Mapper
 */
class PostMapper extends AbstractDbMapper
{
    /**
     * @var string
     */
    protected $tableName = 'posts';

    protected $entityPrototype = 'Socialog\Entity\Post';

    /**
     * Retrieve all posts
     *
     * @return array
     */
    public function findAllPosts()
    {
		$select = new Select($this->tableName);
		$select->order('id DESC');

        return $this->selectWith($select);
    }

    /**
     * Find a post by ID
     *
     * @param  integer               $id
     * @return \Socialog\Entity\Post
     */
    public function findById($id)
    {
        $select = $this
            ->select()
            ->where(array('id' => $id));

        return $this->selectSingle($select);
    }

    /**
     * @param \Socialog\Entity\Post $post
     */
    public function save(PostEntity $post)
    {
        if ($post->getId()) {
            $this->update($post, array(
                'id' => $post->getId()
            ), null, $post->getHydrator());
        } else {
            $this->insert($post, null, $post->getHydrator());
        }
    }
}
