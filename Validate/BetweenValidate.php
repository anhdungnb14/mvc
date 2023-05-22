<?php
namespace Validate;
class BetweenValidate extends Rule
{

    private $min;
    private $max;

    public function __construct($min, $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function passedValidate($fieldName, $valueRule, $dataForm)
    {
        if ($this->min <= strlen($valueRule) && strlen($valueRule) <= $this->max) {
            return true;
        }
        return false;
    }

    public function getMessage($fieldName, $message)
    {
        return $message ?? $fieldName . ' must between ' . $this->min . ' and ' . $this->max . ' character';
    }
}
