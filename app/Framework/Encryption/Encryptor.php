<?php

namespace Framework\Encryption;

class Encryptor
{
    public function encrypt($data): string{
        return md5($data);
    }


}