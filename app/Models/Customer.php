<?php

namespace Models;

use Core\Model;

/**
 * Class Menu
 */
class Customer extends Model
{
    function __construct()
    {
        $this->table_name = "customer";
    }
}
