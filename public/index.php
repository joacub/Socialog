<?php

use Zend\Loader\AutoloaderFactory;
use Zend\Mvc\Application;

chdir(dirname(__DIR__));

require 'vendor/Zend/Loader/AutoloaderFactory.php';

AutoloaderFactory::factory(array(
    'Zend\Loader\StandardAutoloader' => array(
        'autoregister_zf' => true
    )
));

// Run the application!
Application::init(include 'config/application.config.php')->run();
