<?php

return array(
    'socialog' => array(
        'database' => array(
            'driver' => 'Pdo_Mysql',
            'database' => 'socialog',
            'username' => 'root',
            'password' => ''
        ),
    ),
    /**
     * Doctrine
     */
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'params' => array(
                    'host' => 'localhost',
                    'dbname' => 'socialog',
                    'user' => '',
                    'password' => '',
                )
            )
        ),
        'configuration' => array(
            'orm_default' => array(
                'metadata_cache' => 'array',
                'query_cache' => 'array',
                'result_cache' => 'array',
                'generate_proxies' => true,
                'proxy_dir' => 'data/DoctrineORMModule/Proxy',
                'proxy_namespace' => 'DoctrineORMModule\Proxy'
            )
        ),
    ),
);
