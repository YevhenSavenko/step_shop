<?php

namespace Framework\API\Data\Db;

use Framework\Model\AbstractModel;

interface DbInterface
{

    public function load($id): AbstractModel;

    // return AbstractModel
    public function save(AbstractModel $object);

    public function delete(AbstractModel $object);
}