<?php

namespace Controllers;

use Core\Controller;
use Core\DB;
use Core\Helper;


/**
 * Class OrderController
 */
class OrderController extends Controller
{
    public function indexAction()
    {
        $user = [];

        if (empty($_SESSION['products']['basket']['id'])) {
            Helper::redirect('/error/error404');
            return;
        }

        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' && filter_input(INPUT_POST, 'order')) {
            $model = $this->getModel('Order');
            $validValues = $model->validValuesOrder($model->getPostValues());

            if ($validValues !== 0) {
                $result = $model->dataPreparation($validValues);
                $lastId = $model->addItem($result, $model->getColumns())
                    ->getLastId();

                $model->addOrderProducts($lastId);
                $_SESSION['products']['basket']['order'] = 'active';
                Helper::redirect("/order/generate?id={$lastId}");
            } else {
                $user = $model->getPostValues();
            }
        } else if (Helper::getCustomer()) {
            $user = Helper::getCustomer();
        }

        $this->set('user', $user);
        $this->set('title', 'Замовлення');
        $this->renderLayout();
        $this->getModel('Order')->initStatus();
    }

    public function listAction()
    {
        $this->set('title', 'Всі замовлення');

        if ($user = Helper::getCustomer()) {
            $orders = $this->getModel('Order')->getAllOrders($user['customer_id']);

            $this->set('orders', $orders);
        } else {
            Helper::redirect('/error/error404');
            return;
        }

        $this->renderLayout();
    }

    public function generateAction()
    {
        if (isset($_SESSION['products']['basket']['order']) && $_SESSION['products']['basket']['order'] = 'active') {
            $this->set('total', $_SESSION['products']['basket']['total']);
            $this->set('orderId', $this->getModel('Order')->getId());
            $_SESSION['products']['basket'] = [];

            $this->renderLayout();
        } else {
            Helper::redirect('/error/error404');
        }
    }

    public function allAction()
    {
        if (Helper::isAdmin()) {
            $this->set('title', 'Всі замовлення');
            $orders = $this->getModel('Order')->getAllOrders();

            $this->set('orders', $orders);
            $this->renderLayout();
        } else {
            Helper::redirect('/error/error404');
        }
    }
}
