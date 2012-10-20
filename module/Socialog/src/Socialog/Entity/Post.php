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

    /**
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
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
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = (int) $id;
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
        $this->title = $title;
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
    
    public function fromArray(array $data)
    {
        
    }

    public function toArray()
    {
        return array();
    }
}
