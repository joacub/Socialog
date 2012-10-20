<?php

namespace Socialog;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * Service Configuration
     *
     * @return array
     */
    public function getServiceConfig()
    {
        return include __DIR__ . '/config/service.config.php';
    }
    
    /**
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * View Helper Configuration
     * 
     * @return array
     */
    public function getViewHelperConfig()
    {
        return include __DIR__ . '/config/view_helpers.config.php';
    }

}
