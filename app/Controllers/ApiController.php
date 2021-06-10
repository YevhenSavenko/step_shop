<?php

namespace Controllers;

use Core\Controller;
use Core\DB;

/**
 * Class ApiController
 */

class  ApiController extends Controller
{
    public function indexAction()
    {
        $this->forward('error/error404');
    }


    public function priceAction()
    {
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET') {
            if (filter_input(INPUT_GET, 'get') === 'price') {
                $sql = "select max(price) as max from products;";

                $db = new DB();
                $max = $db->query($sql)[0]['max'];

                echo json_encode($max);
                exit;
            }
        }

        $this->forward('error/error404');
    }
}
