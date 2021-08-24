<?php

namespace Framework\Settings\Layout\Validator;

use Framework\API\Data\Validator\CompositeValidatorInterface;
use Framework\Settings\Layout\Validator\Attributes\
{
    SrcValidator,
    IntegrityValidator,
    CrossoriginValidator
};

class ConfigScriptsValidatorComposite implements CompositeValidatorInterface
{
    private $validators = [];

    private $result = '';

    public function __construct()
    {
        $this->validators[] = new SrcValidator();
        $this->validators[] = new IntegrityValidator();
        $this->validators[] = new CrossoriginValidator();
    }

    public function validate($params): string
    {
        foreach ($this->validators as $validator) {
            if ($validator instanceof CompositeValidatorInterface) {
                $this->result .= $validator->validate($params);
            }
        }
        return $this->result;
    }
}