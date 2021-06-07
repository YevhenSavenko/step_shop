<?php

namespace Controllers;

use Core\Controller;
use Core\Helper;
use Core\View;

/**
 * Class CustomerController
 */

class CustomerController extends Controller
{
    public function indexAction()
    {
        $this->forward('customer/list');
    }

    public function listAction()
    {
        $this->set('title', "Клієнти");

        $customers = $this->getModel('Customer')
            ->initCollection()
            ->getCollection()
            ->select();

        $this->set('customers', $customers);

        $this->renderLayout();
    }

    public function loginAction()
    {
        $this->set('title', "Ввійти");
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
            $customerModel = $this->getModel('customer');
            $email = filter_input(INPUT_POST, 'email');
            $password = md5(filter_input(INPUT_POST, 'password'));
            $params = array(
                'email' => $email,
                'password' => $password
            );
            $customer = $customerModel->initCollection()
                ->filter($params)
                ->getCollection()
                ->selectFirst();
            if (!empty($customer)) {
                $_SESSION['id'] = $customer['customer_id'];
                Helper::redirect('/index/index');
            } else {
                $customerModel->initStatus(2, 'Неправильно введені дані');
            }
        }
        $this->renderLayout();
        $this->getModel('customer')->initStatus();
    }

    public function registerAction()
    {
        $this->set('title', 'Реєстрація');
        $customerObject = $this->getModel('customer');


        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
            $result = $customerObject->validValuesRegister($customerObject->getPostValues());

            if ($result !== 0) {
                $filterParams = ['email' => $result['email']];
                $isExists = $customerObject->initCollection()->filter($filterParams)->getCollection()->selectFirst();

                if (!$isExists) {
                    $result['password'] = md5($result['password']);
                    $result['last_name'] = ucfirst(filter_var($result['last_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                    $result['first_name'] = ucfirst(filter_var($result['first_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                    $result['city'] = ucfirst(filter_var($result['city'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));

                    $customerObject->addItem($result, $customerObject->getColumns())->initStatus(1, 'Реєстрація пройшла успішно');
                    Helper::redirect('/customer/login');
                    return;
                } else {
                    $customerObject->initStatus(2, 'Такий емейл вже існує.');
                }
            }
        }

        $this->renderLayout();
        $this->getModel('customer')->initStatus();
    }

    public function logoutAction()
    {
        $_SESSION = [];

        if (!empty($_COOKIE[session_name()])) {
            setcookie(session_name(), "", time() - 3600, "/");
        }

        session_destroy();
        Helper::redirect('/index/index');
    }
}
