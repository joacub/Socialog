<?php

namespace Socialog\Model;

/**
 * Profile model
 */
class Profile extends AbstractModel
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $photoUrl;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPhotoUrl()
    {
        return $this->photoUrl;
    }

    public function setPhotoUrl($photoUrl)
    {
        $this->photoUrl = $photoUrl;
    }

}
