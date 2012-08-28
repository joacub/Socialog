<?php

namespace Socialog;

use Zend\Cache\StorageFactory;

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