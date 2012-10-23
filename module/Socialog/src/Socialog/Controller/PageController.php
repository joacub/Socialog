<?php

namespace Socialog\Controller;

use Zend\View\Model\ViewModel;

/**
 * Page
 */
class PageController extends AbstractController
{
    public function viewAction()
    {
        $sl = $this->getServiceLocator();
        $config = $sl->get('Config');

        $pageMapper = $sl->get('socialog_page_mapper');

        $viewModel = new ViewModel;
        $viewModel->setTemplate('@theme/page.twig');
        $viewModel->page = $pageMapper->findById($this->params('id'));

        $layout =  $this->layout();
        $layout->pages = $pageMapper->findAllPages();
        $layout->profile = $config['profile'];

        return $viewModel;
    }
}
