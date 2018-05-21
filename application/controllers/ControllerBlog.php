<?php

class ControllerBlog extends Controller
{
    /**
     * ControllerBlog constructor.
     */
    public function __construct()
    {
        $this->model = new ModelBlog();
        parent::__construct();
    }

    /**
     *
     */
    public function indexAction()
    {
        $data = $this->model->getPosts();
        $this->view->generate('blog_view.php', $data);
    }

    /**
     * @param $myKey
     */
    public function postAction($myKey)
    {
        $data = $this->model->getContentOneNews($myKey);
        $this->view->generate('single_view.php', $data);
    }

}