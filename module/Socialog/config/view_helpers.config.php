<?php

namespace Socialog;

return array(
    'factories' => array(
        'triggerevent' => function($sm) {
            $sm = $sm->getServiceLocator();
            $triggerEvent = new View\Helper\TriggerEvent();
            $triggerEvent->setEventManager($sm->get('EventManager'));
            return $triggerEvent;
        },
        'profile' => function($sm) {
            $sm = $sm->getServiceLocator();
            $config = $sm->get('Config');
            $profileHelper = new View\Helper\Profile;
            $profileHelper->setProfile(new Model\Profile($config['profile']));
            return $profileHelper;
        }
    )
);