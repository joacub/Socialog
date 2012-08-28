<?php

namespace Socialog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;

class AbstractController extends AbstractActionController
{
    public function onDispatch(MvcEvent $e)
    {
        $sm = $this->getServiceLocator();

        $viewManager = $sm->get('View');
        $twigRenderingStrategy = $sm->get('TwigViewStrategy');
        $viewManager->getEventManager()->attach($twigRenderingStrategy, 100);

//		$twig = $sl->get('TwigViewRenderer')->getEngine();

        // Add themes to template stack
        $templateStack = $sm->get('ViewTemplatePathStack');
        $templateStack->addPath('themes/default');

        $layout = $this->layout();
        $layout->pages = $sm->get('socialog_page_mapper')->findAllPages();

        parent::onDispatch($e);
    }
}
