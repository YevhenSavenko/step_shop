<?php

namespace Framework\Core\Application;

use Framework\Api\Traits\DataControl;
use Model\Menu\ResourceModel\Collection\Menu;
use Framework\Request\Route;

class Builder
{
    use DataControl;

    private $layoutPath;

    private $template;

    private $menuCollection;

    public function __construct($data)
    {
        $this->_data = $data;
        $this->layoutPath = Launch::getLayoutPath();
        $this->setData('menu', Launch::getViewDir() . \DS . 'menu.php');
        $this->setData('template', $this->setDefaultPath());
        $this->menuCollection = new Menu();
    }

    public function renderLayout()
    {
        $this->setMenuCollection();
        require_once $this->layoutPath;
    }

    public function setMenuCollection()
    {
        $menuCollection = $this->menuCollection
            ->queryCollection()
            ->getCollection();

        $this->setData('menuCollection', $menuCollection);
    }

    private function setDefaultPath($template = ''): string
    {
       try{
           $template = $this->foldDefaultPath();
       }catch (\Exception $e){
           $template  = $this->foldErrorPage();
       }

       return $template;
    }

    public function foldDefaultPath(): string
    {
        $viewPath = Launch::getViewDir() . \DS . Route::getController() . \DS . Route::getAction() . '.php';

        if(!file_exists($viewPath)){
            throw new \LogicException();
        }

        return $viewPath;
    }

    public function foldErrorPage(): string
    {
        return Launch::getViewDir() . \DS . 'error' . \DS . 'error404' . '.php';
    }
}