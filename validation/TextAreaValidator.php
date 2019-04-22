<?php
namespace validation;

class TextAreaValidator extends Validator
{
    public function eachValidate(): bool
    {
        $convertStr = mb_convert_kana($this->str, 'n');
        if (preg_match('/\A[\r\n[:^cntrl:]]+\z/u', $convertStr) !== 1) {
            return false;
        }
        return true;
    }
}