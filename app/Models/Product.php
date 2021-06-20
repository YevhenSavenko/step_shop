<?php

namespace Models;

use Core\DB;
use Core\Model;

/**
 * Class Product
 */
class Product extends Model
{

    /**
     * Product constructor.
     */
    function __construct()
    {
        $this->table_name = "products";
        $this->id_column = "id";
    }

    public function validValues($data)
    {
        $data['sku'] = filter_var($data['sku'], FILTER_SANITIZE_SPECIAL_CHARS);
        $data['name'] = filter_var($data['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $data['price'] = filter_var($data['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $data['description'] = htmlspecialchars($data['description']);

        if (!isset($data['qty']) || $data['qty'] < 0) {
            $data['qty'] = 0.000;
        } else {
            filter_var($data['qty'], FILTER_SANITIZE_NUMBER_INT);
        }

        if ($data['price'] < 0) {
            $data['price'] = 0.0;
        }

        return $data;
    }

    public function getDiapasoneValue()
    {
        $minPrice = filter_input(INPUT_POST, 'min-price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $maxPrice = filter_input(INPUT_POST, 'max-price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
            setcookie('min', $minPrice, 0, '/', '', 0, 1);
            setcookie('max', $maxPrice, 0, '/', '', 0, 1);
        } else {
            $minPrice = isset($_COOKIE['min']) ? $_COOKIE['min'] : $minPrice;
            $maxPrice = isset($_COOKIE['max']) ? $_COOKIE['max'] : $maxPrice;
        }

        return ['min' => $minPrice, 'max' => $maxPrice];
    }


    public function filterProduct($params)
    {
        if ($params['min'] || $params['min'] == 0 && $params['max']) {
            $where = ' where price >= ? && price <= ? ';

            $this->sql = $this->sql . $where;
            $this->params = [$params['min'], $params['max']];
        }

        return $this;
    }

    public function fileСheck()
    {
        $status = 0;
        $text = '';

        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
            if ($_FILES['userfile']['error'] === 1) {
                $status = 2;
                $text = 'Занадто великий файл';
            } else if ($_FILES['userfile']['error'] === 2) {
                $status = 2;
                $text = 'Максимальний розмір файлу 1 МБ';
            } else if ($_FILES['userfile']['error'] === 3) {
                $status = 2;
                $text = 'Завантаження файлу обірвалося';
            } else if ($_FILES['userfile']['error'] === 4) {
                $status = 2;
                $text = 'Файл не був завантажений';
            } else if ($_FILES['userfile']['error'] === 6 || $_FILES['userfile']['error'] === 7  || $_FILES['userfile']['error'] === 8) {
                $status = 2;
                $text = 'Дана дія недоступна, спробуйте пізніше';
            } else if ($_FILES['userfile']['type'] !== 'text/xml') {
                $status = 2;
                $text = 'Файл неправильного формату (Файли повинні бути формату .xml)';
            } else {
                $status = 1;
            }
        }

        if ($status === 2) {
            $this->initStatus(2, $text);
            return 0;
        } else if ($status === 1) {
            return 1;
        }
    }

    public function validDataProduct($data)
    {
        $text = '';
        $status = 'ok';

        foreach ($data as $key => $value) {

            if ($text === '' && $value === 'empty') {
                $text = "В продукті з ідентифікатором <b>{$data['id']}</b> поле '{$key}'";
                $status = 'no';
            } else if ($text !== '' && $value === 'empty') {
                $text .= ", '{$key}'";
            }
        }

        if ($text !== '') {
            $text .= ' не існує або пусте. <br>';
        }

        return ['text' => $text, 'status' => $status];
    }

    public function updateProductList($objectList)
    {
        $data = [];
        $problemText = '';

        if ((array)$objectList) {
            $columns = $this->getColumns();

            foreach ($objectList as $product) {
                if (property_exists($product, $this->id_column) && filter_var($product->{$this->id_column}, FILTER_VALIDATE_INT)) {
                    foreach ($columns as $nameField) {
                        if (empty((string)$product->$nameField) || !property_exists($product, $nameField)) {
                            $data[$nameField] = 'empty';
                        } else {
                            $data[$nameField] = (string)$product->$nameField;
                        }
                    }

                    $checkValid = $this->validDataProduct($data);

                    if (empty($checkValid['text']) && $checkValid['status'] === 'ok') {
                        $validData = $this->validValues($data);

                        if ($this->getItem($product->{$this->id_column})) {
                            $id = (string)$product->{$this->id_column};

                            $this->updateItem($validData, $columns, $id);
                        } else {
                            $this->addItem($validData, $columns);
                        }
                    } else {
                        $problemText .= $checkValid['text'];
                    }
                }
            }
        }

        if (!empty($problemText)) {
            $problemText .= 'Виправте файл для перелічених продуктів, та відправте знову. В інших продуктах проблем не виникло і їх було додано в базу даних';
        }

        return $problemText;
    }
}
