<?php

namespace Controllers;

use Core\Controller;
use Core\Helper;

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
        $id = $this->getId();

        if ($id && $basketModel->getItem($id)) {
            $_SESSION['products']['basket']['id'][$basketModel->getId()] = 1;
            Helper::redirect('/basket/list');
            return;
        }

        Helper::redirect('/product/list');
    }

    public function listAction()
    {
        $this->set('title', "Корзина");
        $basketModel = $this->getModel('Basket');

        if (isset($_SESSION['products']['basket']['id']) && !empty($_SESSION['products']['basket']['id'])) {
            $this->set('infoProduct', $_SESSION['products']['basket']['id']);
            $ids = array_keys($_SESSION['products']['basket']['id']);

            $products = $basketModel
                ->initCollection()
                ->filter($ids)
                ->getCollection()
                ->select();
        } else {
            $_SESSION['products']['basket']['total'] = 0;
            $products = '';
        }

        if (isset($_POST['flag']) && $_POST['flag'] === 'update') {
            if (!empty($products)) {
                $idProduct = $products[$_POST['id']]['id'];
                $_SESSION['products']['basket']['id'][$idProduct] = $_POST['qty'];
                exit;
            }
        }

        if (!empty($products)) {
            $totalPrice = 0;

            foreach ($_SESSION['products']['basket']['id'] as $id => $qty) {
                foreach ($products as $product) {
                    if ($product['id'] == $id) {
                        $totalPrice += $product['price'] * $qty;
                    }
                }
            }

            $_SESSION['products']['basket']['total'] = $totalPrice;
            $this->set('totalPrice', $totalPrice);
            $this->set('quantityProducts', array_sum($_SESSION['products']['basket']['id']));
        }

        $this->set('products', $products);
        $this->renderLayout();
    }

    public function deleteAction()
    {
        $model = $this->getModel('Basket');
        $id = $this->getId();

        if ($id && $model->getItem($id)) {
            unset($_SESSION['products']['basket']['id'][$id]);
        }

        Helper::redirect('/basket/list');
    }

    public function clearAction()
    {
        $_SESSION['products']['basket'] = [];
        Helper::redirect('/basket/list');
    }

    public function getId()
    {
        return filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    }
}

// SELECT * FROM `basket_product` JOIN `products` on `basket_product`.`product_id` = `products`.`id` WHERE `basket_product`.`order_id` = 1;
// SELECT * FROM `orders` JOIN `order_products` on `orders`.`id` = `order_products`.`order_id` JOIN `products` on `order_products`.`product_id` = `products`.`id` where `customer_id` = 7 && `order_id` = 27;
