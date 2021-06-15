<?php

namespace Models;

use Core\DB;
use Core\Model;

/**
 * Class Order
 */
class Order extends Model
{
    function __construct()
    {
        $this->table_name = "orders";
        $this->id_column = "id";
    }

    public function validValuesOrder($formData)
    {
        $status = 1;
        $text = '';

        if (is_array($formData) && count($formData) > 0) {
            if (
                !isset($formData['last_name']) || !isset($formData['first_name']) ||
                !isset($formData['email']) || !isset($formData['telephone']) || !isset($formData['address'])
            ) {
                $status = 0;
                $text = 'Одне з полів не заповнено';
            } else if (mb_strlen($formData['last_name']) > 15) {
                $status = 0;
                $text = 'В прізвищі занадто багато символів';
            } else if (mb_strlen($formData['first_name']) > 15) {
                $status = 0;
                $text = 'В імені занадто багато символів';
            } else if (!preg_match('/^\+380\d{9}$/', $formData['telephone']) && !preg_match('/^0\d{9}$/', $formData['telephone'])) {
                $status = 0;
                $text = 'Телефон вказано в неправильному форматі (Формати: +380999227744 або 0999227744)';
            } else if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
                $status = 0;
                $text = 'Неправильний email';
            }
        } else {
            $status = 0;
            $text = 'Щось пішло не так, спробуйте повторити пізніше';
        }

        if ($status !== 0) {
            return $formData;
        } else {
            $this->initStatus(2, $text);
            return 0;
        }
    }

    public function dataPreparation($data)
    {
        $data['last_name'] = filter_var($data['last_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $data['first_name'] = filter_var($data['first_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $data['address'] = filter_var($data['address'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $data['date'] = date('Y-m-d H:i:s');
        $data['total'] = $_SESSION['products']['basket']['total'];

        isset($_SESSION['id']) ? $data['customer_id'] = $_SESSION['id'] : $data['customer_id'] = null;

        return $data;
    }


    public function addOrderProducts($lastId)
    {
        $sql = "insert into order_products (id, order_id, product_id, qty_order) values ";
        $params = [];
        $count = 1;
        $lastKey = array_key_last($_SESSION['products']['basket']['id']);

        foreach ($_SESSION['products']['basket']['id'] as $id => $qty) {
            $sql .= sprintf('(%s,%s,%s,%s)', 'null', ":lastId{$count}", ":id{$count}", ":qty{$count}");

            if ($lastKey !== $id) {
                $sql .= ',';
            }

            $params[":lastId{$count}"] = $lastId;
            $params[":id{$count}"] = $id;
            $params[":qty{$count}"] = $qty;

            $count++;
        }

        $db = new DB();
        $db->query($sql, $params);
    }

    public function getOrdersIds($id = null)
    {
        $sql = "select id from orders";
        $params = [];

        if ($id) {
            $sql .= ' where customer_id = ? ';
            $params[] = $id;
        }

        $sql .= ' order by id desc;';

        $db = new DB();
        return $db->query($sql, $params);
    }

    public function getAllOrders($userId = null)
    {
        $idsOrders = $this->getOrdersIds($userId);
        $db = new DB();
        $orders = [];

        foreach ($idsOrders as $key => $id) {
            $params = [];

            $sqlProducts = "SELECT * FROM `order_products` JOIN `products` on `order_products`.`product_id` = `products`.`id` WHERE `order_products`.`order_id` = ?;";
            $sqlOrders = "select * from orders where id = ?;";


            $params[] = $id['id'];

            $orders[] = ['info' => array_merge($db->query($sqlOrders,  $params)[0], ['products' => $db->query($sqlProducts,  $params)])];
        }

        return $orders;
    }
}
