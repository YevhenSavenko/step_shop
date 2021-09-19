<?php

namespace Controller\Product;

use Framework\API\Data\Controller\Action\Action;
use Framework\API\Traits\DataControl;
use Framework\Authorization\Session;
use Framework\Request\Http;

class Add implements Action
{
    use DataControl;

    private $session;

    private $request;

    public function __construct()
    {
        $this->session = new Session();
        $this->request = new Http();
    }

    public function execute()
    {
        if(!$this->session->isAdmin()){
            $this->request->redirect('/error/404error');
        }

        $this->setData('btn', 'Додати');
        $this->setData('heading', 'Додати товар');

        return $this->_data;
    }
}