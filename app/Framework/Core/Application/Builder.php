<?php

namespace Framework\Core\Application;

use Framework\Api\Traits\DataControl;
use Model\Menu\ResourceModel\Collection\Menu;

class Builder
{
    use DataControl;

    private $layoutPath;

    private $_menuCollection;

    public function __construct($data)
    {
        $this->_data = $data;
        $this->layoutPath = Launch::getLayoutPath();
        $this->setData('menu', Launch::getViewDir() . \DS . 'menu.php');
        $this->_menuCollection = new Menu();
    }

    public function renderLayout()
    {
        $this->setMenuCollection();
        echo require_once $this->layoutPath;
    }

    public function setMenuCollection()
    {
        $menuCollection = $this->_menuCollection
            ->queryCollection()
            ->getCollection();

        $this->setData('menuCollection', $menuCollection);
    }

    public function setPageStyle($href, $rel, $integrity, $crossorigin)
    {

    }

}