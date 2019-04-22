<?php
use PHPUnit\Framework\TestCase;
use validation\TextValidator;
use validation\ValidatorConfig;

require_once __DIR__.'/../validation/Validator.php';
require_once __DIR__.'/../validation/TextValidator.php';
require_once __DIR__.'/../validation/ValidatorConfig.php';

class TextValidatorTest extends TestCase
{
   /**
     * @test
     */
    public function testTextValidator()
    {
        $config = new ValidatorConfig('正しく入力して');
        $validator = new TextValidator($config, '1234');
        $result = $validator->isValidate();
        $this->assertTrue($result->isValid());

        $config = new ValidatorConfig('正しく入力して');
        $validator = new TextValidator($config, 'あいうadkl');
        $result = $validator->isValidate();
        $this->assertTrue($result->isValid());

        $config = new ValidatorConfig('正しく入力して');
        $validator = new TextValidator($config, "あいう\nadkl");
        $result = $validator->isValidate();
        $this->assertFalse($result->isValid());

        $config = new ValidatorConfig('正しく入力して');
        $validator = new TextValidator($config, "あいう\tadkl");
        $result = $validator->isValidate();
        $this->assertFalse($result->isValid());

    }
}