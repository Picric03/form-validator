<?php
use PHPUnit\Framework\TestCase;
use validation\ValidatorConfig;
use validation\TextAreaValidator;

require_once __DIR__.'/../validation/Validator.php';
require_once __DIR__.'/../validation/ValidatorConfig.php';
require_once __DIR__.'/../validation/TextAreaValidator.php';

class TextAreaValidatorTest extends TestCase
{
       /**
     * @test
     */
    public function TextAreaValidator()
    {
        $config = new ValidatorConfig('正しく入力して');
        $validator = new TextAreaValidator($config, "あいう\nadkl");
        $result = $validator->isValidate();
        $this->assertTrue($result->isValid());

        $config = new ValidatorConfig('正しく入力して');
        $validator = new TextAreaValidator($config, "あいう\tadkl");
        $result = $validator->isValidate();
        $this->assertFalse($result->isValid());

        $config = new ValidatorConfig('正しく入力して');
        $config->setCharWidth(ValidatorConfig::CHAR_WIDTH_EM);
        $validator = new TextAreaValidator($config, "あいう\tadkl");
        $result = $validator->isValidate();
        $this->assertFalse($result->isValid());

        $config = new ValidatorConfig('正しく入力して');
        $config->setCharWidth(ValidatorConfig::CHAR_WIDTH_EN);
        $validator = new TextAreaValidator($config, "adkl");
        $result = $validator->isValidate();
        $this->assertTrue($result->isValid());
    }
}

