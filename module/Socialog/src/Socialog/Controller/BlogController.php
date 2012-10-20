<?php

namespace Socialog\Controller;

use Socialog\View\Model\Theme;
use Zend\View\Model\ViewModel;

class BlogController extends AbstractController
{
    public function homeAction()
    {
        $this->layout('@theme/layout.twig');

        $sl = $this->getServiceLocator();
        $postMapper = $sl->get('socialog_post_mapper');
        
        $entityManager = $sl->get('doctrine.entitymanager.orm_default');
        
        $post = $entityManager->find('Socialog\Entity\Post', 1);
        
        var_dump($post);
        
        $viewModel = new ViewModel;
        $viewModel->setTemplate('@theme/home.twig');
        $viewModel->posts = $postMapper->findAllPosts();

        return $viewModel;
    }

    public function postAction()
    {
        $viewModel = new ViewModel;
        $viewModel->setTemplate('post');

        $viewModel->comments = array(
            array(
                'name' => 'Roy',
                'comment' => 'Dit is een test comment 1',
            ),
            array(
                'name' => 'Roy',
                'comment' => 'Dit is een test comment 2',
            ),
        );

        return $viewModel;
    }
}
