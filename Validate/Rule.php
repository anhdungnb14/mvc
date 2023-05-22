<?php
namespace Validate;
abstract class Rule
{
    abstract public function passedValidate($fieldName, $valueRule, $dataForm);

    abstract public function getMessage($fieldName, $message);
}
