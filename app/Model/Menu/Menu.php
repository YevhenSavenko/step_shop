<?php

namespace Model\Menu;

use Framework\API\Data\Model\Menu\MenuInterface;
use Framework\Model\AbstractModel;

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
        $this->setData($id, self::ID);
        return $this;
    }

    /**
     * @param $name
     * @return MenuInterface
     */
    public function setName($name): MenuInterface
    {
        $this->setData($name, self::NAME);
        return $this;
    }

    /**
     * @param $path
     * @return MenuInterface
     */
    public function setPath($path): MenuInterface
    {
        $this->setData($path, self::PATH);
        return $this;
    }

    /**
     * @param int $isActive
     * @return MenuInterface
     */
    public function setIsActive(int $isActive): MenuInterface
    {
        $this->setData((int)$isActive, self::IS_ACTIVE);
        return $this;
    }

    /**
     * @param $sortOrder
     * @return MenuInterface
     */
    public function setSortOrder($sortOrder): MenuInterface
    {
        $this->setData($sortOrder, self::SORT_ORDER);
        return $this;
    }
}