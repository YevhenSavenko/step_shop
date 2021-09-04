<?php

namespace Framework\MessageManager;

class MessageManager
{
    public function errorMessage($message)
    {
        $_SESSION['alerts']['messages']['status'] = 'error';
        $this->setMessage($message);
    }

    public function accessMessage($message)
    {
        $_SESSION['alerts']['messages']['status'] = 'access';
        $this->setMessage($message);
    }

    public function setMessage($message)
    {
        $_SESSION['alerts']['messages']['body'] = $message;
    }

    public function resetMessageStatus()
    {
        unset($_SESSION['alerts']);
    }
}