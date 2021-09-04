<?php

namespace Controller\Customer;

use Framework\API\Data\Controller\Action\Action;
use Framework\API\Traits\DataControl;
use Framework\MessageManager\MessageManager;
use Framework\Request\Http;
use Model\Customer\ResourceModel\Collection\Customer as CustomerCollection;

class Authorization implements Action
{
    use DataControl;

    private $customerCollection;

    private $request;

    private $messageManager;

    public function __construct()
    {
        $this->customerCollection = new CustomerCollection();
        $this->request = new Http();
        $this->messageManager = new MessageManager();
    }
    public function execute()
    {
        $dataEmail = $this->request->getParams('email');
        $dataPassword = md5($this->request->getParams('password'));

        $this->customerCollection->addFieldToFilter('email', ['eq' => $dataEmail])
            ->addFieldToFilter('password', ['eq' => $dataPassword])->getSelect();

        if(empty($this->customerCollection->getCollection())){
            $this->messageManager->errorMessage('Неправильно введені дані');
            $this->request->redirect('/customer/login/');
        }

        $_SESSION['id'] = $this->customerCollection->selectFirst()->getCustomerId();
        $this->request->redirect('/index/index/');

        return $this->_data;
    }
}