<?php

namespace Controller\Customer;

use Framework\API\Data\Controller\Action\Action;
use Framework\API\Traits\DataControl;
use Framework\Encryption\Encryptor;
use Framework\MessageManager\MessageManager;
use Model\Customer\Customer as CustomerModel;
use Model\Customer\ResourceModel\Customer as ResourceCustomerModel;
use Framework\Request\Http;
use Model\Customer\Validator\RegisterValidatorComposite;

class Registration implements Action
{
    use DataControl;

    private $customerModel;

    private $request;

    private $validator;

    private $messageManager;

    private $encryptor;

    private $resourceCustomerModel;

    public function __construct()
    {
        $this->customerModel = new CustomerModel();
        $this->request = new Http();
        $this->validator = new RegisterValidatorComposite();
        $this->messageManager = new MessageManager();
        $this->encryptor = new Encryptor();
        $this->resourceCustomerModel = new ResourceCustomerModel();
    }

    public function execute()
    {
        if($this->request->getRequest() !== 'POST'){
            $this->request->redirect('/product/catalog/');
        }

        try {
            $this->validator->validate($this->request->getParams());
        } catch (\Exception $e) {
            $this->messageManager->errorMessage($e->getMessage());
            $this->request->redirect('/customer/register/');
        }

        $data = $this->request->getParams();
        $data['password'] = $this->encryptor->encrypt($this->request->getParams('password'));

        $this->customerModel->setData($data);
        $this->resourceCustomerModel->save($this->customerModel);

        $this->messageManager->accessMessage('Реєстрація пройшла успішно');
        $this->request->redirect('/customer/login/');
    }
}
