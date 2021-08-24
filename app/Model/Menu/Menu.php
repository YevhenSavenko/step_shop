<?php

namespace Model\Menu;


use Framework\Model\AbstractModel;
use Model\API\Model\Menu\MenuInterface;

class Menu extends AbstractModel implements MenuInterface
{
    /**
     * @return int
     */
    public function getId(): int
    {
        return (int)$this->getData(self::ID);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getData(self::NAME);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->getData(self::PATH);
    }

    /**
     * @return int
     */
    public function getIsActive(): int
    {
        return (int)$this->getData(self::IS_ACTIVE);
    }

    /**
     * @return int
     */
    public function getSortOrder(): int
    {
        return $this->getData(self::SORT_ORDER);
    }

    /**
     * @param $id
     * @return MenuInterface
     */
    public function setId($id): MenuInterface
    {
        return $this->setData($id, self::ID);
    }

    /**
     * @param $name
     * @return MenuInterface
     */
    public function setName($name): MenuInterface
    {
        return $this->setData($name, self::NAME);
    }

    /**
     * @param $path
     * @return MenuInterface
     */
    public function setPath($path): MenuInterface
    {
        return $this->setData($path, self::PATH);
    }

    /**
     * @param int $isActive
     * @return MenuInterface
     */
    public function setIsActive(int $isActive): MenuInterface
    {
        return $this->setData((int)$isActive, self::IS_ACTIVE);
    }

    /**
     * @param $sortOrder
     * @return MenuInterface
     */
    public function setSortOrder($sortOrder): MenuInterface
    {
        return $this->setData($sortOrder, self::SORT_ORDER);
    }
}