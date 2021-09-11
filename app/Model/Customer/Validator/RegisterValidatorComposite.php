<?php

namespace Model\Customer\Validator;

use Framework\API\Data\Validator\CompositeValidatorInterface;
use Model\Customer\Validator\Fields\CityValidator;
use Model\Customer\Validator\Fields\ConfirmPasswordValidator;
use Model\Customer\Validator\Fields\EmailValidator;
use Model\Customer\Validator\Fields\FirstNameValidator;
use Model\Customer\Validator\Fields\LastNameValidator;
use Model\Customer\Validator\Fields\PasswordValidator;
use Model\Customer\Validator\Fields\TelephoneValidator;

class RegisterValidatorComposite implements CompositeValidatorInterface
{
    private $validators = [];

    public function __construct()
    {
        $this->validators[] = new EmailValidator();
        $this->validators[] = new FirstNameValidator();
        $this->validators[] = new LastNameValidator();
        $this->validators[] = new PasswordValidator();
        $this->validators[] = new ConfirmPasswordValidator();
        $this->validators[] = new TelephoneValidator();
        $this->validators[] = new CityValidator();
    }

    public function validate($params): string
    {
        foreach ($this->validators as $validator){
            $validator->validate($params);
        }

        return true;
    }
}