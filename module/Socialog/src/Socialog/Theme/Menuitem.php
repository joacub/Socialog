<?php

namespace Socialog\Theme;

class Menuitem
{
    protected $name;
    protected $url;

    public function __construct($name, $url)
    {
        $this->name = $name;
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('<li><a href="%s">%s</a></li>', $this->url, $this->name);
    }
}
