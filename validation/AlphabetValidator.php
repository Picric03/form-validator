<?php
namespace validation;

class AlphabetValidator extends Validator
{
    public function __construct(AlphabetValidatorConfig $config, string $str)
    {
        $this->config = $config;
        \mb_convert_encoding($str, 'UTF-8');
        $this->str = $str;
    }


    public function eachValidate(): bool
    {
        $regularExpression = '/\A[a-zA-Z]+\z/u';
        if ($this->config->getIsContainsNumbers()) {
            $regularExpression = '/\A[a-zA-Z0-9]+\z/u';
        }

        $convertStr = mb_convert_kana($this->str, 'nr');
        if (preg_match($regularExpression, $convertStr) !== 1) {
            return false;
        }
        return true;
    }
}