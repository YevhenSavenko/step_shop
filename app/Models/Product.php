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
        $data['qty'] = filter_var($data['qty'], FILTER_SANITIZE_NUMBER_INT);
        $data['price'] = filter_var($data['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $data['description'] = htmlspecialchars($data['description']);


        if ($data['price'] < 0) {
            $data['price'] = 0;
        }

        if ($data['qty'] < 0) {
            $data['qty'] = 0;
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
}
