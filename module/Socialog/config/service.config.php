<?php

namespace Socialog;

use Zend\Cache\StorageFactory;
use Zend\Log;

return array(

    'invokables' => array(
        'socialog_user_mapper'	=> 'Socialog\Mapper\UserMapper',
        'socialog_post_mapper'	=> 'Socialog\Mapper\PostMapper',
        'socialog_page_mapper'	=> 'Socialog\Mapper\PageMapper',
    ),

    'factories' => array(
        'socialog_db' => function($sm) {
            $config = $sm->get('Config');
            return new \Zend\Db\Adapter\Adapter($config['socialog']['database']);
        },
        'socialog_cache' => function($sm) {
            $config = $sm->get('Config');
            $storage = StorageFactory::factory(array(
                'adapter' => $config['socialog']['cache'],
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

        /**
         * Logging
         */
        'socialog_logger' => function($sm) {
            $logger = new Log\Logger;
            $stream = new Log\Writer\Stream('data/log/' . date('Y-m-d') . '.txt');
            $format = "%timestamp% %priorityName%: %message% %info%";
            $stream->setFormatter(new Log\Formatter\Simple($format, 'd-m-Y H:i:s'));
            $logger->addWriter($stream);

            $criticalStream = new Log\Writer\Stream('data/log/' . date('Y-m-d') . '-critical.txt');
            $format = "%timestamp%: %message% %info%";
            $criticalStream->setFormatter(new Log\Formatter\Simple($format, 'd-m-Y H:i:s'));
            $criticalStream->addFilter(new Log\Filter\Priority(Log\Logger::ERR, '>='));
            $logger->addWriter($criticalStream);

            return $logger;
        },
    ),

    'initializers' => array(
        'socialog_db' => function($instance, $sm) {
            if ($instance instanceof Mapper\AbstractDoctrineMapper) {
                $instance->setEntityManager($sm->get('doctrine.entitymanager.orm_default'));
            }
        },
        'socialog_cache' => function($instance, $sm) {
            if ($instance instanceof Cache\CacheAwareInterface) {
                $instance->setCacheStorage($sm->get('socialog_cache'));
            }
        },
    ),
);
