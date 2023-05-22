<?php
use Validate\RequiredValidate;
use Validate\EmailValidate;
use Validate\MinValidate;
use Validate\BetweenValidate;
use Validate\RequiredWithValidate;
class ValidateService
{
    private $dataForm = [];
    private $rules = [];
    private $errors = [];
    private $messages = [];
    private $ruleMapsClass = [
        'required' => RequiredValidate::class,
        'email' => EmailValidate::class,
        'min' => MinValidate::class,
        'between' => BetweenValidate::class,
        'required_with' => RequiredWithValidate::class,
    ];

    public function __construct($dataForm)
    {
        $this->dataForm = $dataForm;
    }

    public function setRules($rules)
    {
        foreach ($rules as $key => $value) {
            $itemValue = explode('|', $value);
            $rules[$key] = $itemValue;
        }

        $this->rules = $rules;
    }


    public function validate()
    {
        foreach ($this->rules as $fieldName => $ruleArray) {
            $valueRule = $this->dataForm[$fieldName];

            foreach ($ruleArray as $ruleItem) {
                $ruleAndOptional = explode(':', $ruleItem);
                $ruleName = $ruleAndOptional[0];
                $optional = explode(',', end($ruleAndOptional));
                $className = $this->ruleMapsClass[$ruleName];
                $classNameInstace = new $className(...$optional);
                if (!$classNameInstace->passedValidate($fieldName, $valueRule, $this->dataForm)) {
                    $keyMessage = $fieldName . '.' . $ruleName;
                    $this->errors[$fieldName][] = $classNameInstace->getMessage($fieldName, $this->messages[$keyMessage] ?? null);
                }
            }
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function countErorrs()
    {
        if (is_array($this->errors) && count($this->errors)) {
            return true;
        }
        return false;
    }

    public function setMessages($messages)
    {
        $this->messages = $messages;
    }
}
