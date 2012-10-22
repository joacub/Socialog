<?php

namespace Socialog\Entity;

use Socialog\Model\AbstractModel;
use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 * @ORM\Entity
 * @ORM\Table(name="posts")
 */
class Post extends AbstractModel implements EntityInterface
{

    const STATUS_PUBLISHED = 1;
    const STATUS_DRAFT = 2;

    /**
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="title")
     */
    protected $title;

    /**
     * @var string
     * @ORM\Column(name="content")
     */
    protected $content;

    /**
     * @var string
     * @ORM\Column(name="content_html")
     */
    protected $content_html;

    /**
     * @var integer
     * @ORM\Column(name="status", type="integer")
     */
    protected $status;

    /**
     * Filterconfig
     */
    protected $inputFilter = array(
        'id' => array(
            'required' => false,
        ),
        'title' => array(
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'string_length',
                    'options' => array(
                        'min' => 8
                    ),
                ),
            ),
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
        ),
        'content' => array(
            'required' => true,
        ),
    );

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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = trim($title);
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContentHtml()
    {
        return $this->content_html;
    }

    /**
     * @param string $content_html
     */
    public function setContentHtml($content_html)
    {
        $this->content_html = $content_html;
    }
    
    /**
     * Status
     * 
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    /**
     * @param integer $status
     */
    public function setStatus($status)
    {
        $this->status = (int) $status;
    }

}
