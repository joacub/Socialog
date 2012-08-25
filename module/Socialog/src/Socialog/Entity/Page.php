<?php

namespace Socialog\Entity;

use Socialog\Model\AbstractModel;

class Page extends AbstractModel implements EntityInterface
{

	/**
	 * @var integer
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $content;
	
	/**
	 * Page Title
	 * 
	 * @var string
	 */
	protected $title;
	
    /**
     * Filterconfig
     */
    protected $inputFilter = array(
        'id' => array(
            'required' => false,
        ),
        'title' => array(
            'required' => true,
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
	 * Set ID
	 * @param integer $id
	 */
	public function setId($id)
	{
		$this->id = (int) $id;
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
}
