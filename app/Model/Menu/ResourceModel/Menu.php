<?php

namespace Model\Menu\ResourceModel;

use Framework\ResourceModel\Db\AbstractDb;

class Menu extends AbstractDb
{
    private $_collection;

    public function _construct()
    {
        $this->_init('menu', 'id', \Model\Menu\Menu::class);
    }

}