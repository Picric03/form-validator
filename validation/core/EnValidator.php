<?php
namespace validation\core;

class EnValidator
{
    public static function isEn(string $str): bool
    {
        if (preg_match('/\A[[:ascii:]]+\Z/u', $str) !== 1) {
            return false;
        }
        return true; 
    }
}