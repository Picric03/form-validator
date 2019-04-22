<?php
use PHPUnit\Framework\TestCase;
use validation\AlphabetValidator;
use validation\AlphabetValidatorConfig;

require_once __DIR__.'/../validation/Validator.php';
require_once __DIR__.'/../validation/AlphabetValidator.php';
require_once __DIR__.'/../validation/AlphabetValidatorConfig.php';

class AlphabetValidatorTest extends TestCase
{
    /**
     * @test
     */
    public function testAlphabetValidator()
    {
        $config = new AlphabetValidatorConfig('アルファベットで入力してね');
        $config->setIsContainsNumbers(false);
        $validator = new AlphabetValidator($config, "adkl");
        $result = $validator->isValidate();
        $this->assertTrue($result->isValid());

        $config = new AlphabetValidatorConfig('アルファベットで入力してね');
        $config->setIsContainsNumbers(false);
        $validator = new AlphabetValidator($config, "adkl123");
        $result = $validator->isValidate();
        $this->assertFalse($result->isValid());

        $config = new AlphabetValidatorConfig('アルファベットで入力してね');
        $config->setIsContainsNumbers(true);
        $validator = new AlphabetValidator($config, "adkl123");
        $result = $validator->isValidate();
        $this->assertTrue($result->isValid());

        $config = new AlphabetValidatorConfig('アルファベットで入力してね');
        $config->setIsContainsNumbers(true);
        $validator = new AlphabetValidator($config, "adk");
        $result = $validator->isValidate();
        $this->assertTrue($result->isValid());
    }
}