<?php

namespace Socialog\Controller;

use Socialog\Form\CommentForm;
use Socialog\Entity\Comment as CommentEntity;
use Zend\View\Model\ViewModel;

class PostController extends AbstractController
{
    public function overviewAction()
    {
        $sl = $this->getServiceLocator();
        $postMapper = $sl->get('socialog_post_mapper');

        $viewModel = new ViewModel;
        $viewModel->setTemplate('@theme/home.twig');
        $viewModel->posts = $postMapper->findLatestPosts();

        return $viewModel;
    }

    public function viewAction()
    {
        $sl = $this->getServiceLocator();

        $viewModel = new ViewModel;
        $viewModel->setTemplate('@theme/post.twig');

        /* @var $postMapper \Socialog\Mapper\PostMapper */
        $postMapper = $sl->get('socialog_post_mapper');
        /* @var $commentMapper \Socialog\Mapper\CommentMapper */
        $commentMapper = $sl->get('socialog_comment_mapper');

        $post = $postMapper->findById($this->params('id'));

        $viewModel->post = $post;
        $viewModel->comments = $commentMapper->findByEntity($post);

        // Prepare comments
        $commentEntity = new CommentEntity;
        $commentForm = new CommentForm();
        $commentForm->bind($commentEntity);
        $commentForm->setInputFilter($commentEntity->getInputFilter());

        $request = $this->getRequest();

        if ($request->isPost()) {
            $commentForm->setData($request->getPost());
            if ($commentForm->isValid()) {
                $commentEntity->setEntityId($post->getId());
                $commentEntity->setEntityType(1);
                $commentMapper->save($commentEntity);
                
                $this->postredirectget();
            }
        }
        
        $viewModel->commentForm = $commentForm;

        return $viewModel;
    }
}
