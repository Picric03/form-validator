<?php
namespace validation;

require_once __DIR__.'/ValidatorConfig.php';

class AlphabetValidatorConfig extends ValidatorConfig
{
    protected $isContainsNumbers = false;

    public function setIsContainsNumbers(bool $isContains): void
    {
        $this->isContainsNumbers = $isContains;
    }

    public function getIsContainsNumbers(): bool
    {
        return $this->isContainsNumbers;
    }
}