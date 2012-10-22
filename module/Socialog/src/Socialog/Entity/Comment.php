<?php

namespace Socialog\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Socialog\Model\AbstractModel;

/**
 * @ORM\Entity
 * @ORM\Table(name="comments")
 */
class Comment extends AbstractModel
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     * @var integer
     */
    protected $id;
    
    /**
     * @ORM\Column(name="username")
     * @var string
     */
    protected $username;
    
    /**
     * @ORM\Column(name="comment")
     * @var string
     */
    protected $comment;
    
    /**
     * @ORM\Column(name="post_date", type="datetime")
     * @var DateTime
     */
    protected $date;
    
    /**
     * @ORM\Column(name="entity_id", type="integer")
     * @var integer
     */
    protected $entityId;
    
    /**
     * @ORM\Column(name="entity_type", type="integer")
     * @var integer
     */
    protected $entityType;
    
    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
    
    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }
    
    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }
    
    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    
    /**
     * 
     * @param DateTime $date
     */
    public function setDate(DateTime $date)
    {
        $this->date = $date;
    }
}