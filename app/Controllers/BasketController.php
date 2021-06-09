<?php

namespace Controllers;

use Core\Controller;

/**
 * Class BasketController
 */

class  BasketController extends Controller
{
    public function indexAction()
    {
    }

    public function addAction()
    {
        $basketModel = $this->getModel('Basket');

        if (!isset($_SESSION['products']['basket'])) {
            $_SESSION['products']['basket']['id'] = array($basketModel->getId());
        } else {
            array_push($_SESSION['products']['basket']['id'], $basketModel->getId());
        }
        // $customers = $this->getModel('Customer')
        //     ->initCollection()
        //     ->getCollection()
        //     ->select();

        // $this->set('customers', $customers);

        // $this->renderLayout();
    }

    public function clearAction()
    {
        $_SESSION = [];
    }
}
