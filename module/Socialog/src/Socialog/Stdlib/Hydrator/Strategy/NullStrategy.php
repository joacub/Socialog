<?php

namespace Socialog\Stdlib\Hydrator\Strategy;

use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

/**
 * Replace value by null
 */
class NullStrategy implements StrategyInterface
{
    public function extract($value)
    {
        return null;
    }

    public function hydrate($value)
    {
        return null;
    }

}
