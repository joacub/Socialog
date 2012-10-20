<?php

namespace Socialog\View\Helper;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\View\Helper\AbstractHelper;

class TriggerEvent extends AbstractHelper implements EventManagerAwareInterface
{
    /**
     * @var EventManagerInterface
     */
    protected $events;

    /**
     * @return EventManagerInterface
     */
    public function getEventManager()
    {
        return $this->events;
    }

    /**
     * @param EventManagerInterface $eventManager
     */
    public function setEventManager(EventManagerInterface $eventManager)
    {
        $eventManager->setIdentifiers('render');
        $this->events = $eventManager;
    }

    /**
     * @param type $eventName
     * @param type $argv
     */
    public function __invoke($eventName, $argv = array())
    {
        $this->getEventManager()->trigger($eventName, $this->getView(), $argv);
    }

}