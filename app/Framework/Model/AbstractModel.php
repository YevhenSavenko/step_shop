<?php

namespace Framework\Model;

use Framework\Core\Data\DataObject;

abstract class AbstractModel extends DataObject
{
    private $idFieldName = 'id';

    private $data = [];

    public function setData($data, $key = null): self
    {
        if($key === null){
            $this->data = $data;
        } else {
            $this->data[$key] = $data;
        }

        return $this;
    }

    /**
     * @param null $key
     * @return array|string
     */
    public function getData($key = null)
    {
        if($key === null){
            return $this->data;
        }

        return $this->data[$key];
    }

    public function getId(): int
    {
        return (int)$this->data[$this->idFieldName];
    }

    public function setId($id):self
    {
        (int)$this->data[$this->idFieldName] = $id;
        return $this;
    }

}