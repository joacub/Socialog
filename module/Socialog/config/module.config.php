<?php

return array(

    'socialog' => array(
        'database' => array(
            'driver' => 'Pdo_Mysql',
            'database' => '',
            'username' => '',
            'password' => ''
        ),
        'cache' => array(
            'name' => 'filesystem',
            'options' => array(
                'cachedir' => 'data/cache',
                'ttl' => 3600,
                'dir_permission' => 0760,
                'file_permission' => 0660,
            ),
        ),
    ),

    /**
     * Router Configuration
     */
    'router' => array(
        'routes' => array(
            'socialog-blog' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'socialog-blog',
                        'action'     => 'home',
                    ),
                ),
            ),
            /**
             * Pages Route
             */
            'socialog-page' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/page/:id',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller'	=> 'socialog-page',
                        'action'		=> 'view',
                    ),
                ),
            ),
        ),
    ),

    /**
     * Controller Configuration
     */
    'controllers' => array(
        'invokables' => array(
            'socialog-blog' => 'Socialog\Controller\BlogController',
            'socialog-page' => 'Socialog\Controller\PageController',
        ),
    ),

    /**
     * ViewManager Configuration
     */
    'view_manager' => array(
        'display_not_found_reason'	=> true,
        'display_exceptions'		=> true,
        'doctype'					=> 'HTML5',
        'not_found_template'		=> 'error/404',
        'layout'					=> 'layout',
        'exception_template'		=> 'error/index',
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
