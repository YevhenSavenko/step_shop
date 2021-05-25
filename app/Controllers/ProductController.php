<?php

namespace Controllers;

use Core\Controller;
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

        $products = $this->getModel('Product')
            ->initCollection()
            ->sort($this->getSortParams())
            ->getCollection()
            ->select();
        $this->set('products', $products);

        $this->renderLayout();
    }

    /**
     *
     */
    public function viewAction()
    {
        $this->set('title', "Карточка товара");

        $product = $this->getModel('Product')
            ->initCollection()
            ->filter(['id', $this->getId()])
            ->getCollection()
            ->selectFirst();
        $this->set('products', $product);

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
                $this->set('product', $model->getItem($id));
                $this->set('saved', 1);
            } else {
                $this->set('id', $id);
            }
        }

        $edit = filter_input(INPUT_POST, 'edited');
        if ($edit) {
            $values = $model->validValues($model->getPostValues());
            $model->updateItem($values, $columns, $id);
            Helper::redirect('/product/list?status=ok_edit');
        }

        $this->renderLayout();
    }

    public function addAction()
    {

        $model = $this->getModel('Product');
        $columns = implode(',', $model->getColumns());
        $this->set("title", "Додавання товару");
        $this->set('headding', 'Додавання товару');
        if ($values = $model->getPostValues()) {
            $values = $model->validValues($values);
            $model->addItem($values, $columns);
            Helper::redirect('/product/list?status=ok_add');
        }

        $this->renderLayout();
    }

    /**
     * @return array
     */
    public function getSortParams()
    {
        $params = [];
        $sortproduct = filter_input(INPUT_POST, 'sortproduct');

        if (isset($sortproduct)) {
            $sortfirst = filter_input(INPUT_POST, 'sortfirst');

            if ($sortfirst === "price_DESC") {
                $params['price'] = 'desc';
            } else {
                $params['price'] = 'asc';
            }

            $sortsecond = filter_input(INPUT_POST, 'sortsecond');

            if ($sortsecond === "qty_DESC") {
                $params['qty'] = 'desc';
            } else {
                $params['qty'] = 'asc';
            }
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
