<?php

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction($request = null)
    {
        var_dump($request);
        $user = User::getInstance()->fetchAll();
        $this->getView()->render('index/index', ['users' => $user]);
    }

    public function addAction()
    {
        if (Request::isPost()) {
            $result = User::getInstance()->save($_REQUEST, User::getInstance()->getTable());
        }
    }

    public function deleteAction()
    {
        if (Request::isDelete()) {
            parse_str(file_get_contents('php://input'), $post_content);
            $result = User::getInstance()->delete($post_content, User::getInstance()->getTable());
        }
    }

    public function updateAction()
    {
        if (Request::isPut()) {
            parse_str(file_get_contents('php://input'), $post_content);
            $result = User::getInstance()->save($post_content, User::getInstance()->getTable());
        }
    }
}
