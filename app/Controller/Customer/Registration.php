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




//
//        if (!$isExists) {
//            $result['password'] = md5($result['password']);
//            $result['last_name'] = ucfirst(filter_var($result['last_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
//            $result['first_name'] = ucfirst(filter_var($result['first_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
//            $result['city'] = ucfirst(filter_var($result['city'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
//
//            $customerObject->addItem($result, $customerObject->getColumns())->initStatus(1, 'Реєстрація пройшла успішно');
//            Helper::redirect('/customer/login');
//            return;
//        } else {
//            $customerObject->initStatus(2, 'Такий емейл вже існує.');
//        }
//    }
//}
//
//$this->renderLayout();
//$this->getModel('customer')->initStatus();



//if (is_array($values) && count($values) > 0) {
//    if (
//        !isset($values['last_name']) || !isset($values['first_name']) ||
//        !isset($values['email']) || !isset($values['telephone']) ||
//        !isset($values['password']) || !isset($values['confirm_password']) || !isset($values['city'])
//    ) {
//        $status = 0;
//        $text = 'Одне з полів не заповнено';
//    } else if (mb_strlen($values['last_name']) > 15) {
//        $status = 0;
//        $text = 'В прізвищі занадто багато символів';
//    } else if (mb_strlen($values['first_name']) > 15) {
//        $status = 0;
//        $text = 'В імені занадто багато символів';
//    } else if (!preg_match('/^\+380\d{9}$/', $values['telephone']) && !preg_match('/^0\d{9}$/', $values['telephone'])) {
//        $status = 0;
//        $text = 'Телефон вказано в неправильному форматі (Формати: +380999227744 або 0999227744)';
//    } else if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
//        $status = 0;
//        $text = 'Неправильний email';
//    } else if (!preg_match("/^[A-z0-9]+$/", $values['password'])) {
//        $status = 0;
//        $text = 'Пароль повинен містити тільки символи латинського алфавіту та цифри.';
//    } else if (!preg_match("/[A-Z]+/", $values['password'])) {
//        $status = 0;
//        $text = 'Пароль повинен містити хоча б одну заголовну літеру.';
//    } else if (!preg_match("/[a-z]+/", $values['password'])) {
//        $status = 0;
//        $text = 'Пароль повинен містити хоча б одну малельку літеру.';
//    } else if (!preg_match("/[0-9]+/", $values['password'])) {
//        $status = 0;
//        $text = 'Пароль повинен містити хоча б одну цифру.';
//    } else if (strlen($values['password']) > 25 || strlen($values['password']) < 8) {
//        $status = 0;
//        $text = 'Пароль повинен містити мінімум 8 символів та максимум 25 символів';
//    } else if ($values['password'] !== $values['confirm_password']) {
//        $status = 0;
//        $text = 'Паролі не співпадають.';
//    }
//} else {
//    $status = 0;
//    $text = 'Щось пішло не так, спробуйте повторити пізніше';
//}
