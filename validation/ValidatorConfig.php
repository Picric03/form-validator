<?php
namespace validation;

class ValidatorConfig
{
    // 半角、全角許可
    const CHAR_WIDTH_EM = 'em';       // 全角
    const CHAR_WIDTH_EN = 'en';       // 半角
    const CHAR_WIDTH_NONE = 'none';   // 指定なし

    protected $charWidth = self::CHAR_WIDTH_NONE; 
    protected $errMessage;
    protected $maxLength;
    protected $minLength;

    public function __construct(string $errMessage)
    {
        $this->errMessage = $errMessage;
    }

    public function setCharWidth(string $charWidth): void
    {
        if ($charWidth !== self::CHAR_WIDTH_EM && $charWidth !== self::CHAR_WIDTH_EN
        && $charWidth !== self::CHAR_WIDTH_NONE) {
            throw new \InvalidArgumentException(
                '$charWidthは ValidatorConfig::CHAR_WIDTH_EM | ValidatorConfig::CHAR_WIDTH_EN 
                | ValidatorConfig::CHAR_WIDTH_NONE で指定してください。');
        }

        $this->charWidth = $charWidth;
    }

    public function setMaxLength(int $maxLength): void
    {
        $this->maxLength = $maxLength;
    }

    public function setMinLength(int $minLength): void
    {
        $this->minLength = $minLength;
    }

    public function getCharWidth(): string
    {
        return $this->charWidth;
    }

    public function getErrMessage(): string
    {
        return $this->errMessage;
    }

    public function getMaxLength()
    {
        return $this->maxLength;
    }

    public function getMinLength()
    {
        return $this->minLength;
    }

}