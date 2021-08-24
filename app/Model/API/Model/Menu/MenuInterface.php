<?php

namespace Model\API\Model\Menu;

interface MenuInterface
{
    const ID = 'id';
    const NAME = 'name';
    const PATH = 'path';
    const IS_ACTIVE = 'active';
    const SORT_ORDER = 'sort_order';

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getPath(): string;

    /**
     * @return int
     */
    public function getIsActive(): int;

    /**
     * @return int
     */
    public function getSortOrder(): int;

    /**
     * @param $id
     * @return MenuInterface
     */
    public function setId($id): MenuInterface;

    /**
     * @param $name
     * @return MenuInterface
     */
    public function setName($name): MenuInterface;

    /**
     * @param $path
     * @return MenuInterface
     */
    public function setPath($path): MenuInterface;

    /**
     * @param int $isActive
     * @return MenuInterface
     */
    public function setIsActive(int $isActive): MenuInterface;

    /**
     * @param $sortOrder
     * @return MenuInterface
     */
    public function setSortOrder($sortOrder): MenuInterface;
}