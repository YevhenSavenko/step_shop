<?php

namespace Model\Order\Validator;

use Framework\API\Data\Validator\CompositeValidatorInterface;
use Model\Order\Validator\Fields\AddressValidator;
use Model\Order\Validator\Fields\EmailValidator;
use Model\Customer\Validator\Fields\FirstNameValidator;
use Model\Customer\Validator\Fields\LastNameValidator;
use Model\Customer\Validator\Fields\TelephoneValidator;

class OrderValidatorComposite implements CompositeValidatorInterface
{
    private $validators = [];

    public function __construct()
    {
        $this->validators[] = new EmailValidator();
        $this->validators[] = new FirstNameValidator();
        $this->validators[] = new LastNameValidator();
        $this->validators[] = new TelephoneValidator();
        $this->validators[] = new AddressValidator();
    }


    public function validate($params): ?string
    {
        foreach ($this->validators as $validator){
            $validator->validate($params);
        }

        return true;
    }
}
