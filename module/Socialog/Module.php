<?php

namespace Socialog;

use Zend\Cache\StorageFactory;

class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

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
     * Service Config
     *
     * @return array
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'socialog_db' => function($sm) {
                    $config = $sm->get('Config');

                    return new \Zend\Db\Adapter\Adapter($config['socialog']['database']);
                },
                'socialog_cache' => function($sm) {
                    $config = $sm->get('Config');

                    $storage = StorageFactory::factory(array(
                        'adapter' => array(
                            'name' => 'filesystem',
                            'options' => array(
                                'cachedir'			=> 'data/cache',
                                'ttl'				=> 3600,
                                'dir_permission'	=> 0760,
                                'file_permission'	=> 0660,
                            ),
                        ),
                        'plugins' => array(
                            array(
                                'name' => 'serializer',
                                'options' => array(
                                    'serializer' => 'Zend\Serializer\Adapter\PhpCode',
                                ),
                            ),
                        ),
                    ));

                    return $storage;
                },
            ),
            'initializers' => array(
                'socialog_db' => function($instance, $sm) {
                    if ($instance instanceof Mapper\AbstractDbMapper) {
                        $instance->setDbAdapter($sm->get('socialog_db'));
                    }
                },
                'socialog_cache' => function($instance, $sm) {
                    if ($instance instanceof Cache\CacheAwareInterface) {
                        $instance->setCacheStorage($sm->get('socialog_cache'));
                    }
                },
            ),
        );
    }

}
