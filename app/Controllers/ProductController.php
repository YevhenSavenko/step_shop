<?php

namespace Controllers;

use Core\Controller;
use Core\DB;
use Core\Helper;
use Core\View;

/**
 * Class ProductController
 */
class ProductController extends Controller
{
    public function indexAction()
    {
        $this->forward('product/list');
    }

    /**
     *
     */
    public function listAction()
    {
        $this->set('title', "Товари");
        $model = $this->getModel('Product');
        $maxPrice = $model->getMaxValue('price');
        $this->set('maxPrice', $maxPrice);

        $products = $model
            ->initCollection()
            ->filterProduct($model->getDiapasoneValue())
            ->sort($this->getSortParams())
            ->getCollection()
            ->select();
        $this->set('products', $products);

        $this->renderLayout();
        $model->initStatus();
    }

    /**
     *
     */
    public function viewAction()
    {
        $this->set('title', "Карточка товара");

        $product = $this->getModel('Product')
            ->initCollection()
            ->filter(['id' => $this->getId()])
            ->getCollection()
            ->selectFirst();
        $this->set('product', $product);

        $this->renderLayout();
    }

    /**
     *
     */
    public function editAction()
    {
        $model = $this->getModel('Product');
        $columns = $model->getColumns();
        $this->set('saved', 0);
        $this->set("title", "Редагування товару");
        $this->set('id', '');
        $id = $this->getId();
        if ($id) {
            if ($model->getItem($id)) {
                $this->set('headding', 'Редагування товару');
                $this->set('btn', 'Редагувати');
                $this->set('product', $model->getItem($id));
                $this->set('saved', 1);
            } else {
                $this->set('id', $id);
            }
        }

        $edit = filter_input(INPUT_POST, 'edited');
        if ($edit) {
            $values = $model->validValues($model->getPostValues());
            $model->updateItem($values, $columns, $id)->initStatus(1, 'Редагування відбулось успішно');

            Helper::redirect('/product/list');
            return;
        }

        $this->renderLayout();
        $model->initStatus();
    }

    public function addAction()
    {
        $model = $this->getModel('Product');
        $columns = $model->getColumns();
        $this->set("title", "Додавання товару");
        $this->set('headding', 'Додавання товару');
        $this->set('btn', 'Додати');
        if ($values = $model->getPostValues()) {
            $values = $model->validValues($values);
            $id = $model->addItem($values, $columns)->getMaxValue('id');
            $model->initStatus(1, 'Успішне додавання товару');
            // Helper::redirect('/product/list?status=ok_add');
            Helper::redirect("/product/edit?id={$id}");
        }

        $this->renderLayout();
    }

    public function deleteAction()
    {
        $model = $this->getModel('Product');
        $id = $this->getId();

        if ($id && $model->getItem($id)) {
            $model->deleteItem()->initStatus(1, 'Товар успішно видалено');;
            // $fieldId = $model->getColumns();
            // $model->deleteItem($fieldId[0], $id);
        } else {
            $model->initStatus(2, 'Такого товару не існує');
        }

        Helper::redirect('/product/list');
    }

    /**
     * @return array
     */
    public function getSortParams()
    {
        $params = [];


        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
            filter_input(INPUT_POST, 'sortfirst') === "price_DESC" ? $params['price'] = 'desc' : $params['price'] = 'asc';
            filter_input(INPUT_POST, 'sortsecond') === "qty_DESC" ? $params['qty'] = 'desc' : $params['qty'] = 'asc';

            setcookie('price', $params['price'], 0, '/', '', 0, 1);
            setcookie('qty', $params['qty'], 0, '/', '', 0, 1);
        } else if (isset($_COOKIE['price']) && isset($_COOKIE['qty'])) {
            $params['price'] = $_COOKIE['price'];
            $params['qty'] = $_COOKIE['qty'];
        }

        if (isset($params['price']) && isset($params['qty'])) {
            $this->set('sortPrice', $params['price']);
            $this->set('sortQty', $params['qty']);
        } else {
            $this->set('sortPrice', '');
            $this->set('sortQty', '');
        }

        return $params;
    }

    /**
     * @return array
     */
    public function getSortParams_old()
    {
        /*
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
        } else 
        { 
            $sort = "name";
        }
         * 
         */
        $sort = filter_input(INPUT_GET, 'sort');
        if (!isset($sort)) {
            $sort = "name";
        }
        /*
        if (isset($_GET['order']) && $_GET['order'] == 1) {
            $order = "ASC";
        } else {
            $order = "DESC";
        }
         * 
         */
        if (filter_input(INPUT_GET, 'order') == 1) {
            $order = "DESC";
        } else {
            $order = "ASC";
        }

        return array($sort, $order);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        /*
        if (isset($_GET['id'])) {
         
            return $_GET['id'];
        } else {
            return NULL;
        }
        */
        return filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    }
}
