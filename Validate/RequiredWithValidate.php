<?php
namespace Validate;
class RequiredWithValidate extends Rule
{
    private $fieldNameReqireWith;

    public function __construct($fieldNameReqireWith)
    {
        $this->fieldNameReqireWith = $fieldNameReqireWith;
    }

    public function passedValidate($fieldName, $valueRule, $dataForm)
    {
        if (!$valueRule && !$dataForm[$this->fieldNameReqireWith]) {
            return false;
        }
        return true;
    }

    public function getMessage($fieldName, $message)
    {
        return $fieldName . ' is required with ' . $this->fieldNameReqireWith;
    }
}
