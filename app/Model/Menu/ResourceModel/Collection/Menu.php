<?php

namespace Model\Menu\ResourceModel\Collection;

use Framework\ResourceModel\Collection\AbstractCollection;

class Menu extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(\Model\Menu\ResourceModel\Menu::class);
    }
}