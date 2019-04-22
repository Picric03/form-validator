<?php
namespace validation;

use validation\result\Result;
use validation\result\Failure;
use validation\result\Success;

require_once __DIR__.'/result/Result.php';
require_once __DIR__.'/result/Failure.php';
require_once __DIR__.'/result/Success.php';
require_once __DIR__.'/core/EnValidator.php';
require_once __DIR__.'/core/EmValidator.php';
require_once __DIR__.'/core/LengthValidator.php';

abstract class Validator
{
    protected $str;
    protected $config;

    public function __construct(ValidatorConfig $config, string $str)
    {
        $this->config = $config;
        \mb_convert_encoding($str, 'UTF-8');
        $this->str = $str;
    }

    public function isValidate(): Result
    {
        if ($this->config->getCharWidth() === ValidatorConfig::CHAR_WIDTH_EM && !$this->isEm()) {
            return new Failure($this->config->getErrMessage());
        } 
        if ($this->config->getCharWidth() === ValidatorConfig::CHAR_WIDTH_EN && !$this->isEn()) {
            return new Failure($this->config->getErrMessage());
        }

        if (!$this->isWithinLengthLimit()) {
            return new Failure($this->config->getErrMessage());
        }

        if(!$this->eachValidate()) {
            return new Failure($this->config->getErrMessage());
        }

        return new Success();
    }

    abstract protected function eachValidate(): bool;

    protected function isEn(): bool
    {
        return \validation\core\EnValidator::isEn($this->str);
    }

    protected function isEm(): bool
    {
        return \validation\core\EmValidator::isEm($this->str);
    }

    /**
     * 文字数のチェック
     */
    protected function isWithinLengthLimit(): bool
    {
        return \validation\core\LengthValidator::isValidLength($this->config, $this->str);
    }
}
