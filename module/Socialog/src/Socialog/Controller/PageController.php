<?php

namespace Socialog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;

class PageController extends AbstractController
{
    public function viewAction()
    {
        $sm = $this->getServiceLocator();
        $layout =  $this->layout();
        $config = $sm->get('Config');

        $id = $this->params('id');

        $pageMapper = $sm->get('socialog_page_mapper');

        $layout->profile = $config['profile'];

        $viewModel = new ViewModel;
        $viewModel->setTemplate('@theme/page.twig');
        $viewModel->page = $pageMapper->findById($id);
        $layout->pages = $pageMapper->findAllPages();

        return $viewModel;
    }
}
