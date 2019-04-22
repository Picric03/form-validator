<?php
namespace validation;

class NumValidator extends Validator
{
    public function eachValidate(): bool
    {
        $convertStr = mb_convert_kana($this->str, 'n');
        if (preg_match('/\A[0-9]+\z/u', $convertStr) !== 1) {
            return false;
        }
        return true;
    }
}