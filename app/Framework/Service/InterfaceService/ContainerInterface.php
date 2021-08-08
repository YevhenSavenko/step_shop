<?php

namespace Service\InterfaceService;


interface ContainerInterface
{
    /**
     * @param $id
     * @return object
     */
    public function get(string $instance): object;

    /**
     * @param $id
     * @return mixed
     */
    public function has($id);
}