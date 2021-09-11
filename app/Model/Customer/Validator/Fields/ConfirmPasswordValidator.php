<?php

namespace Model\Customer\Validator\Fields;

use Framework\API\Data\Validator\CompositeValidatorInterface;
use LogicException;

class ConfirmPasswordValidator implements CompositeValidatorInterface
{
    private const CONFIRM_PASSWORD = 'confirm_password';

    public function validate($params): string
    {
        if (!isset($params[self::CONFIRM_PASSWORD]) || $params[self::CONFIRM_PASSWORD] === '') {
            throw new LogicException("Поле для підтвердження пароля не заповнено");
        }

        if ($params[self::CONFIRM_PASSWORD] !== $params[PasswordValidator::PASSWORD]) {
            throw new LogicException("Паролі не співпадають");
        }

        return true;
    }
}