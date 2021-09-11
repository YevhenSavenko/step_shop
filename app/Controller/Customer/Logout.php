<?php

namespace Controller\Customer;

use Framework\API\Data\Controller\Action\Action;
use Framework\Authorization\Session;
use Framework\Request\Http;

class Logout implements Action
{
    private $request;

    private $session;

    public function __construct()
    {
        $this->request = new Http();
        $this->session = new Session();
    }

    public function execute()
    {
        $this->session->clearSession();
        $this->request->redirect('/index/index');
    }
}