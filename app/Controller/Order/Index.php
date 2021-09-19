<?php

namespace Controller\Order;

use Framework\API\Data\Controller\Action\Action;
use Framework\API\Traits\DataControl;
use Framework\Request\Http;
use Model\Basket\Basket as BasketModel;
use Framework\Authorization\Session;
use Framework\Core\Data\Persistor;
use Model\Customer\Customer;

class Index implements Action
{
    use DataControl;

    private $basketModel;

    private $request;

    private $session;

    private $persistor;

    private $customerModel;

    public function __construct()
    {
        $this->basketModel = new BasketModel();
        $this->request = new Http();
        $this->session = new Session();
        $this->persistor = new Persistor();
        $this->customerModel = new Customer();
    }

    public function execute()
    {
        if(!$this->basketModel->hasProductBasket()){
            $this->request->redirect('/error/error404');
        }

        $data = $this->persistor->get('order_form_data');

        if(null !== $data){
            $this->setData('customer_info', $this->customerModel->setData($data));
            $this->persistor->clear('order_form_data');
            return $this->_data;
        }

        if(null !== $this->session->isLogin()){
            $this->setData('customer_info',  $this->session->isLogin());
        }

        return $this->_data;
    }
}
