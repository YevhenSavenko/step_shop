<?php

namespace Controllers;

use Core\Controller;
use Core\DB;
use Core\Helper;
use Core\Route;
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
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
            if (filter_input(INPUT_POST, 'flag') === 'price') {
                $maxPrice = $this->getModel('Product')->getMaxValue('price');

                echo json_encode($maxPrice);
                exit;
            }
        }

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

        $this->getFormDiapasone($model->getDiapasoneValue(), $maxPrice);



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
        if (Helper::isAdmin()) {
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
        } else {
            Helper::redirect("/error/error404");
        }
    }

    public function addAction()
    {
        if (Helper::isAdmin()) {
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
        } else {
            Helper::redirect("/error/error404");
        }
    }

    public function deleteAction()
    {
        if (Helper::isAdmin()) {
            $model = $this->getModel('Product');
            $id = $this->getId();

            if ($id && $model->getItem($id)) {
                if (array_key_exists($id, $_SESSION['products']['basket']['id'])) {
                    unset($_SESSION['products']['basket']['id'][$id]);
                    $_SESSION['products']['basket']['total'] = $_SESSION['products']['basket']['total'] - $model->getItem($id)['price'];
                }

                $model->deleteItem()->initStatus(1, 'Товар успішно видалено');
                // $fieldId = $model->getColumns();
                // $model->deleteItem($fieldId[0], $id);
            } else {
                $model->initStatus(2, 'Такого товару не існує');
            }

            Helper::redirect('/product/list');
        } else {
            Helper::redirect("/error/error404");
        }
    }

    public function unloadAction()
    {
        if (Helper::isAdmin()) {
            $products = $this->getModel('Product')
                ->initCollection()
                ->getCollection()->select();
            $columns = $this->getModel('Product')
                ->getColumns();

            $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><products/>');

            foreach ($products as $product) {
                $xmlProduct = $xml->addChild('product');

                foreach ($columns as $field) {
                    $xmlProduct->addChild($field, $product[$field]);
                }
            }

            $dom = new \DOMDocument("1.0");
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            $dom->loadXML($xml->asXML());

            $file = fopen('public/products.xml', 'w');
            fwrite($file, $dom->saveXML());
            fclose($file);

            Helper::redirectDownload('public/products.xml');
        } else {
            Helper::redirect("/error/error404");
        }
    }

    public function uploadAction()
    {
        if (Helper::isAdmin()) {
            $this->set("title", "Завантаження файлів");
            $this->set("danger", '');
            $model = $this->getModel('Product');

            $checkFile = $model->fileСheck();

            if ($checkFile) {
                $use_errors = libxml_use_internal_errors(true);
                $xml = simplexml_load_file($_FILES['userfile']['tmp_name']);
                if ($xml) {
                    $textProblem = $model->updateProductList($xml);
                    if (!empty($textProblem)) {
                        $this->set("danger", $textProblem);
                    } else {
                        $model->initStatus(1, 'Оновлення бази пройшло успішно');
                    }
                } else {
                    $model->initStatus(2, 'Неправильно сформовано вміст файла');
                }

                libxml_clear_errors();
                libxml_use_internal_errors($use_errors);
            }


            $this->renderLayout();
            $model->initStatus();
        } else {
            Helper::redirect("/error/error404");
        }
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

    public function getFormDiapasone($diapasone, $maxPrice)
    {
        $min = 0;
        $max = $maxPrice;
        $minRange = 0;
        $maxRange = 100;

        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
            $min = $diapasone['min'];
            $max = $diapasone['max'];
        } else if (isset($_COOKIE['min']) && isset($_COOKIE['min'])) {
            $min = $_COOKIE['min'];
            $max = $_COOKIE['max'];
        }


        $minRange  = (($maxRange * $min) / $maxPrice);
        $maxRange = (($maxRange * $max) / $maxPrice);

        $this->set('min', $min);
        $this->set('max', $max);
        $this->set('minRange', $minRange);
        $this->set('maxRange', $maxRange);
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
