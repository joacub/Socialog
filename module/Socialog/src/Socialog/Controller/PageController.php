<?php

namespace Socialog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;

class PageController extends AbstractActionController
{
    public function onDispatch(MvcEvent $e)
    {
        $sl = $this->getServiceLocator();

        $viewManager = $sl->get('View');
        $twigRenderingStrategy = $sl->get('TwigViewStrategy');
        $viewManager->getEventManager()->attach($twigRenderingStrategy, 100);

        // Add themes to template stack
        $templateStack = $sl->get('ViewTemplatePathStack');
        $templateStack->addPath('themes/default');

        parent::onDispatch($e);
    }

    public function viewAction()
    {
        $sm = $this->getServiceLocator();
        $layout =  $this->layout();
        $config = $sm->get('Config');

        $id = $this->params('id');

        $pageMapper = $sm->get('socialog_page_mapper');

        $layout->profile = $config['profile'];

        $viewModel = new ViewModel;
        $viewModel->setTemplate('page');
        $viewModel->page = $pageMapper->findById($id);
        $layout->pages = $pageMapper->findAllPages();

        return $viewModel;
    }
}
