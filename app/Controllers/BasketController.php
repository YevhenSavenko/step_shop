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
        $this->forward('basket/list');
    }

    public function addAction()
    {
        $basketModel = $this->getModel('Basket');

        if (!isset($_SESSION['products']['basket'])) {
            $_SESSION['products']['basket']['id'] = array($basketModel->getId());
        } else {
            array_push($_SESSION['products']['basket']['id'], $basketModel->getId());
        }
    }

    public function listAction()
    {
        // $this->forward('basket/list');
    }

    public function clearAction()
    {
        $_SESSION = [];
    }
}
