<?php

namespace Model\Basket;

class Basket
{
    public function getBasketProducts(): ?array
    {
        if (!$this->hasProductBasket()) {
            return null;
        }

        return array_keys($_SESSION['products']['basket']['id']);
    }

    public function hasProductBasket(): bool
    {
        if (isset($_SESSION['products']['basket']['id']) && count($_SESSION['products']['basket']['id']) > 0) {
            return true;
        }

        $_SESSION['products']['basket']['total'] = 0;
        return false;
    }

    public function getProductIdsAndQuantity()
    {
        if (!$this->hasProductBasket()) {
            return null;
        }

        return $_SESSION['products']['basket']['id'];
    }

    public function setTotalPrice($price)
    {
        $_SESSION['products']['basket']['total'] = $price;
    }

    public function addToCart($idProduct, $qty = 1)
    {
        $_SESSION['products']['basket']['id'][$idProduct] = $qty;
    }

    public function deleteProduct($idProduct)
    {
        unset($_SESSION['products']['basket']['id'][$idProduct]);
    }

    public function clearCart()
    {
        $_SESSION['products']['basket'] = [];
    }

    public function setActiveOrder()
    {
        $_SESSION['products']['basket']['order'] = 'active';
    }

    public function deleteActiveOrder()
    {
        if (isset($_SESSION['products']['basket']['order'])) {
            unset($_SESSION['products']['basket']['order']);
        }
    }

    public function orderIsActive(): bool
    {
        if (isset($_SESSION['products']['basket']['order']) && $_SESSION['products']['basket']['order'] === 'active') {
            return true;
        }

        return false;
    }

    public static function getTotalQty()
    {
        return isset($_SESSION['products']['basket']['id']) ? array_sum($_SESSION['products']['basket']['id']) : 0;
    }

    public static function getTotalSum()
    {
        return (float)$_SESSION['products']['basket']['total'] ?? 0;
    }

    public static function inBasket($id): bool
    {
        if (isset($_SESSION['products']['basket']['id'])) {
            if (array_key_exists($id, $_SESSION['products']['basket']['id'])) {
                return true;
            }
        }

        return false;
    }
}