<?php
namespace validation\core;

use validation\ValidatorConfig;

class LengthValidator
{
    public static function isValidLength(ValidatorConfig $config, string $str): bool
    {
        $max = $config->getMaxLength();
        $min = $config->getMinLength();
        $strlen = mb_strlen($str);

        if (isset($max) && isset($min)) {
            if ($strlen < $min || $strlen > $max) {
                return false;
            }
        } else if (isset($max)) {
            if ($strlen > $max) {
                return false;
            }
        } else if (isset($min)) {
            if ($strlen < $min) {
                return false;
            }
        }

        return true;
    }
}