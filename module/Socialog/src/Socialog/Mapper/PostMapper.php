<?php

namespace Socialog\Mapper;

use Socialog\Entity\Post as PostEntity;

/**
 * Post Mapper
 */
class PostMapper extends AbstractDoctrineMapper
{
    protected $entityName = 'Socialog\Entity\Post';
    
    /**
     * Retrieve all posts
     *
     * @return array
     */
    public function findLatestPosts()
    {
        $em = $this->getEntityManager();
        
        $qb = $em->createQueryBuilder()
            ->select('p')
            ->from('Socialog\Entity\Post', 'p')
            ->orderBy('p.id', 'desc');
        
        return $qb->getQuery()->getResult();
    }

    /**
     * Find a post by ID
     *
     * @param  integer               $id
     * @return \Socialog\Entity\Post
     */
    public function findById($id)
    {
        return $this->getRepository()->find($id);
    }

    /**
     * @param \Socialog\Entity\Post $post
     */
    public function save(PostEntity $post)
    {
       $this->getEntityManager()->persist($post);
       $this->getEntityManager()->flush($post);
    }
}
