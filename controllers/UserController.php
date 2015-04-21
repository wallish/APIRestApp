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
        header('HTTP/1.0 201 OK');
    }

    public function getAction($request = null)
    {
        if (Request::isGet()) {
            var_dump($request);
            $user = User::getInstance()->fetchAll();
            header('HTTP/1.0 201 OK');
        } else {
            header('HTTP/1.0 405 Method Not Allowed');
        }
    }

    public function addAction()
    {
        if (Request::isPost()) {
            $result = User::getInstance()->save($_REQUEST, User::getInstance()->getTable());
        } else {
            header('HTTP/1.0 405 Method Not Allowed');
        }
    }

    public function deleteAction()
    {
        if (Request::isDelete()) {
            parse_str(file_get_contents('php://input'), $post_content);
            $result = User::getInstance()->delete($post_content, User::getInstance()->getTable());
        } else {
            header('HTTP/1.0 405 Method Not Allowed');
        }
    }

    public function updateAction()
    {
        if (Request::isPut()) {
            parse_str(file_get_contents('php://input'), $post_content);
            $result = User::getInstance()->save($post_content, User::getInstance()->getTable());
        } else {
            header('HTTP/1.0 405 Method Not Allowed');
        }
    }
}
