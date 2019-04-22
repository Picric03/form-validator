<?php
namespace validation;

class TextValidator extends Validator
{
    public function eachValidate(): bool
    {
        if (preg_match('/\A[[:^cntrl:]]+\z/u', $this->str) !== 1) {
            return false;
        }
        return true;
    }
}