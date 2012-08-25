<?php

namespace Socialog\Mapper;

use Socialog\Entity\Page as PageEntity;
use Zend\Db\Sql\Select;

/**
 * Page PMapper
 */
class PageMapper extends AbstractDbMapper
{
    /**
     * @var string
     */
    protected $tableName = 'pages';

    protected $entityPrototype = 'Socialog\Entity\Page';

    /**
     * Retrieve all posts
     *
     * @return array
     */
    public function findAllPages()
    {
        return $this->selectWith(new Select($this->tableName));
    }

    /**
     * Find a post by ID
     *
     * @param  integer               $id
     * @return \Socialog\Entity\Page
     */
    public function findById($id)
    {
        $select = $this
            ->select()
            ->where(array('id' => $id));

        return $this->selectSingle($select);
    }

    /**
     * @param \Socialog\Entity\Page $post
     */
    public function save(PageEntity $post)
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
