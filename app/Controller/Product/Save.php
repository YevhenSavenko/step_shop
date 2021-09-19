<?php

namespace Controller\Product;

use Framework\API\Data\Controller\Action\Action;
use Framework\API\Traits\DataControl;
use Framework\Authorization\Session;
use Framework\MessageManager\MessageManager;
use Framework\Request\Http;
use Model\Products\ResourceModel\Products as ProductsResource;
use Model\Products\Products as ProductModel;
use Model\Products\ResourceModel\Collection\Products as ProductsCollection;

class Save implements Action
{
    use DataControl;

    private $productResource;

    private $request;

    private $messageManager;

    private $productModel;

    private $productsCollection;

    private $session;

    public function __construct()
    {
        $this->productResource = new ProductsResource();
        $this->request = new Http();
        $this->messageManager = new MessageManager();
        $this->productModel = new ProductModel();
        $this->productsCollection = new ProductsCollection();
        $this->session = new Session();
    }

    public function execute()
    {

        if (!$this->session->isAdmin() || $this->request->getRequest() !== 'POST') {
            $this->request->redirect('/error/404error');
        }

        $postData = $this->request->getPostParams();

        if ($this->request->getPostParams('id')) {
            $this->productModel->setData($this->request->getPostParams())->setId($this->request->getPostParams('id'));
            $this->productResource->update($this->productModel);
            $this->messageManager->accessMessage('Редагування пройшло успішно');
            $this->request->redirect('/product/catalog');
        }

        unset($postData['id']);
        $this->productModel->setData($postData);
        $this->productResource->save($this->productModel);
        $id = $this->productsCollection->getLastId();
        $this->messageManager->accessMessage('Додавання товару пройшло успішно');
        $this->request->redirect('/product/edit', ['id' => $id]);
    }


    //if (Helper::isAdmin()) {
//$model = $this->getModel('Product');
//$columns = $model->getColumns();
//$this->set('saved', 0);
//$this->set("title", "Редагування товару");
//$this->set('id', '');
//$id = $this->getId();
//if ($id) {
//if ($model->getItem($id)) {
//$this->set('headding', 'Редагування товару');
//$this->set('btn', 'Редагувати');
//$this->set('product', $model->getItem($id));
//$this->set('saved', 1);
//} else {
//    $this->set('id', $id);
//}
//}
//
//$edit = filter_input(INPUT_POST, 'edited');
//if ($edit) {
//    $values = $model->validValues($model->getPostValues());
//    $model->updateItem($values, $columns, $id)->initStatus(1, 'Редагування відбулось успішно');
//
//    Helper::redirect('/product/list');
//    return;
//}
//
//$this->renderLayout();
//$model->initStatus();
//} else {
//    Helper::redirect("/error/error404");
//}
}