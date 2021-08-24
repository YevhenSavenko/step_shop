<?php

namespace Framework\Settings\Layout\Validator;

use Framework\API\Data\Validator\CompositeValidatorInterface;
use Framework\Settings\Layout\Validator\Attributes\
{
    CrossoriginValidator,
    HrefValidator,
    IntegrityValidator,
    RelValidator
};

class ConfigLinksValidatorComposite implements CompositeValidatorInterface
{
    private $validators = [];

    private $result = '';

    public function __construct()
    {
        $this->validators[] = new HrefValidator();
        $this->validators[] = new RelValidator();
        $this->validators[] = new CrossoriginValidator();
        $this->validators[] = new IntegrityValidator();
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