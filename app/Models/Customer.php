<?php

namespace Models;

use Core\DB;
use Core\Model;

/**
 * Class Menu
 */
class Customer extends Model
{
    function __construct()
    {
        $this->table_name = 'customer';
        $this->id_column = 'customer_id';
    }

    public function getPostValues()
    {
        $values = parent::getPostValues();
        $confirmPass = filter_input(INPUT_POST, 'confirm_password');

        if ($confirmPass && $confirmPass !== $this->id_column) {
            $values['confirm_password'] = $confirmPass;
        }

        return $values;
    }

    public function validValuesRegister($values)
    {
        $status = 1;
        $text = '';

        if (is_array($values) && count($values) > 0) {
            if (
                !isset($values['last_name']) || !isset($values['first_name']) ||
                !isset($values['email']) || !isset($values['telephone']) ||
                !isset($values['password']) || !isset($values['confirm_password']) || !isset($values['city'])
            ) {
                $status = 0;
                $text = 'Одне з полів не заповнено';
            } else if (mb_strlen($values['last_name']) > 15) {
                $status = 0;
                $text = 'В прізвищі занадто багато символів';
            } else if (mb_strlen($values['first_name']) > 15) {
                $status = 0;
                $text = 'В імені занадто багато символів';
            } else if (!preg_match('/^\+380\d{9}$/', $values['telephone']) && !preg_match('/^0\d{9}$/', $values['telephone'])) {
                $status = 0;
                $text = 'Телефон вказано в неправильному форматі (Формати: +380999227744 або 0999227744)';
            } else if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
                $status = 0;
                $text = 'Неправильний email';
            } else if (!preg_match("/^[A-z0-9]+$/", $values['password'])) {
                $status = 0;
                $text = 'Пароль повинен містити тільки символи латинського алфавіту та цифри.';
            } else if (!preg_match("/[A-Z]+/", $values['password'])) {
                $status = 0;
                $text = 'Пароль повинен містити хоча б одну заголовну літеру.';
            } else if (!preg_match("/[a-z]+/", $values['password'])) {
                $status = 0;
                $text = 'Пароль повинен містити хоча б одну малельку літеру.';
            } else if (!preg_match("/[0-9]+/", $values['password'])) {
                $status = 0;
                $text = 'Пароль повинен містити хоча б одну цифру.';
            } else if (strlen($values['password']) > 25 || strlen($values['password']) < 8) {
                $status = 0;
                $text = 'Пароль повинен містити мінімум 8 символів та максимум 25 символів';
            } else if ($values['password'] !== $values['confirm_password']) {
                $status = 0;
                $text = 'Паролі не співпадають.';
            }
        } else {
            $status = 0;
            $text = 'Щось пішло не так, спробуйте повторити пізніше';
        }

        if ($status !== 0) {
            return $values;
        } else {
            $this->initStatus(2, $text);
            return 0;
        }
    }
}
