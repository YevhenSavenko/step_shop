<?php

namespace Framework\Authorization;

use Model\Customer\Customer;
use Model\Customer\ResourceModel\Customer as CustomerResourceModel;

class Session
{
    private $customerModel;

    private $customerResourceModel;

    private $customerLogin;

    public function __construct()
    {
        $this->customerModel = new Customer();
        $this->customerResourceModel = new CustomerResourceModel();
    }

    public function isLogin()
    {
        if(null === $this->customerLogin && isset($_SESSION['id'])){
            $this->customerLogin = $this->customerResourceModel->load((int)$_SESSION['id']);
        }

        return $this->customerLogin;
    }

    public function isAdmin(): bool
    {
        if(null !== $this->isLogin()){
            if($this->isLogin()->getAdminRole()){
                return true;
            }
        }

        return false;
    }


    public function clearSession()
    {
        $_SESSION = [];

        if (!empty($_COOKIE[session_name()])) {
            setcookie(session_name(), "", time() - 3600, "/");
        }

        session_destroy();
    }
}