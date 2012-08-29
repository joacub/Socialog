<?php

namespace Socialog\EventManager;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;

class EventHandler implements ListenerAggregateInterface
{
    /**
     * @var array
     */
    protected $handlers = array();

    /**
     * @var array
     */
    protected $hooks = array();

    /**
     * @var array
     */
    protected $sharedHooks = array();

    /**
     * @param EventManagerInterface $events
     */
    public function attach(EventManagerInterface $events)
    {
        foreach ($this->hooks as $eventName => $methodName) {
            $this->handlers[] = $events->attach($eventName, array($this, $methodName));
        }

        // Hook into sharedEventManager if we have shared hooks
        if (isset($this->sharedHooks) && is_array($this->sharedHooks)) {
            $sharedEventManager = $events->getSharedManager();
            foreach ($this->sharedHooks as $objectName => $events) {
                foreach ($events as $eventName => $methodName) {
                    $priority = 1;
                    if (is_array($methodName)) {
                        $methodName = key($methodName);
                        $priority = $methodName[0];
                    }
                    $sharedEventManager->attach($objectName, $eventName, array($this, $methodName), $priority);
                }
            }
        }
    }

    /**
     * @param EventManagerInterface $events
     */
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->handlers as $key => $handler) {
            $events->detach($handler);
            unset($this->handlers[$key]);
        }
        $this->handlers = array();
    }
}