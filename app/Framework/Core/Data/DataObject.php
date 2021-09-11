<?php

namespace Framework\Core\Data;

use Exception;

class DataObject
{
    public function __call($name, $arguments)
    {
        $dataKey = strtolower(preg_replace('/(?<!^)[A-Z]+|(?<!^|\d)[\d]+/', '_' . '$0', $name));

        try {
            return $this->checkDataControl($dataKey, $arguments[0], $name);
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function checkDataControl($dataKey, $value, $functionName)
    {
        $request = \substr($dataKey, 0, 3);
        $operation = sprintf('%sData', $request);


        if ($request === 'get') {
            return $this->$operation(substr($dataKey, 4));
        } else if ($request === 'set') {
            return $this->$operation($value, substr($dataKey, 4));
        }

        throw new Exception("Function {$functionName} does not exist");
    }
}