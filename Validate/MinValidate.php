<?php
namespace Validate;
class MinValidate extends Rule
{

    private $min;

    public function __construct($min)
    {
        $this->min = $min;
    }

    public function passedValidate($fieldName, $valueRule, $dataForm)
    {
        if (strlen($valueRule) >= $this->min) {
            return true;
        }
        return false;
    }

    public function getMessage($fieldName, $message)
    {
        return $message ?? $fieldName . ' is min ' . $this->min . ' character';
    }
}
