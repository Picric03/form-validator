<?php
namespace validation\core;
class EmValidator
{
    public static function isEm(string $str): bool
    {
        $strlen = mb_strlen($str);
        for ($i = 0; $i < $strlen; $i++) {
            $char = mb_substr($str, $i, 1);
            if (EnValidator::isEn($char)) {
                return false;
            }
        }
        return true;
    }
}