<?php
use PHPUnit\Framework\TestCase;
use validation\NumValidator;
use validation\ValidatorConfig;

require_once __DIR__.'/../validation/ValidatorConfig.php';
require_once __DIR__.'/../validation/Validator.php';
require_once __DIR__.'/../validation/NumValidator.php';



class NumValidatorTest extends TestCase
{
    public function validNumbers(): array
    {
        return [
            ['1234'],
            ['0'],
            ['122929849894839834984383499384'],
            ['１２３４'],
            ['012１２３５12']
        ];
    }

    /**
     * @test
     * @dataProvider validNumbers
     */
    public function validNumberValidate(string $validNumber)
    {
        $config = new ValidatorConfig('数字で入力して');
        $validator = new NumValidator($config, $validNumber);
        $result = $validator->isValidate();
        $this->assertTrue($result->isValid());
    }

    public function invalidNumbers(): array
    {
        return [
            ['aaa'],
            [''],
            [' '],
            ['1.23'],
            ['あああ']
        ];
    }

    /**
     * @test
     * @dataProvider invalidNumbers
     */
    public function invalidNumberValidate(string $invalidNumber)
    {
        $config = new ValidatorConfig('数字で入力して');
        $validator = new NumValidator($config, $invalidNumber);
        $result = $validator->isValidate();
        $this->assertFalse($result->isValid());
        $this->assertSame($result->getReason(), '数字で入力して');
    }

    public function validEmNumbers(): array
    {
        return [
            ['９３０２９８'],
            ['０'],
            ['４０２３１３７４９２４８２９３０１９３０９１０３８９２７４２４２０９５３０５３５９'],
        ];
    }

    /**
     * @test
     * @dataProvider validEmNumbers
     */
    public function validEmNumberValidate(string $validNumber)
    {
        $config = new ValidatorConfig('全角数字で入力してください。');
        $config->setCharWidth(ValidatorConfig::CHAR_WIDTH_EM);
        $validator = new NumValidator($config, $validNumber);
        $result = $validator->isValidate();
        $this->assertTrue($result->isValid());
    }



    public function invalidEmNumbers(): array
    {
        return [
            ['1２３'],
            ['01345'],
            ['1.23'],
            ['012１２３５12'],
            ['あああ'],
            ['0'],
            ['122929849894839834984383499384'],
        ];
    }

    /**
     * @test
     * @dataProvider invalidEmNumbers
     * 
     */
    public function invalidEmNumberValidate(string $invalidNumber)
    {
        $config = new ValidatorConfig('全角数字で入力してください。');
        $config->setCharWidth(ValidatorConfig::CHAR_WIDTH_EM);
        $validator = new NumValidator($config, $invalidNumber);
        $result = $validator->isValidate();
        $this->assertFalse($result->isValid());
        $this->assertSame($result->getReason(), '全角数字で入力してください。');
    }

    public function validEnNumbers(): array
    {
        return [
            ['0'],
            ['122929849894839834984383499384'],
            ['3928']
        ];
    }


    /**
     * @test
     * @dataProvider validEnNumbers
     */
    public function validEnNumberValidate(string $validNumber)
    {
        $config = new ValidatorConfig('半角数字で入力してください。');
        $config->setCharWidth(ValidatorConfig::CHAR_WIDTH_EN);
        $validator = new NumValidator($config, $validNumber);
        $result = $validator->isValidate();
        $this->assertTrue($result->isValid());
    }

    public function invalidEnNumbers(): array
    {
        return [
            ['０'],
            ['1229298498948０２９２８39834984383499384'],
            ['39２９8'],
            ['１２３abkao'],
            ['３９４８０'],
            ['abkd'],
        ];
    }

    /**
     * @test
     * @dataProvider invalidEnNumbers
     */
    public function invalidEnNumberValidate(string $invalidNumber)
    {
        $config = new ValidatorConfig('半角数字で入力してください。');
        $config->setCharWidth(ValidatorConfig::CHAR_WIDTH_EN);
        $validator = new NumValidator($config, $invalidNumber);
        $result = $validator->isValidate();
        $this->assertFalse($result->isValid());
        $this->assertSame($result->getReason(), '半角数字で入力してください。');
    }

    

    public function validMax5OfCharacterNumbers(): array
    {
        return [
            ['12345'],
            ['0'],
            ['9809'],
        ];
    }
    

    /**
     * @test
     * @dataProvider validMax5OfCharacterNumbers
     */
    public function validMaxOfCharacterNumbers(string $validNumber)
    {
        $config = new ValidatorConfig('5文字いないの数字を入力してください。');
        $config->setMaxLength(5);
        $validator = new NumValidator($config, $validNumber);
        $result = $validator->isValidate();
        $this->assertTrue($result->isValid());
    }

    public function invalidMax5OfCharacterNumbers(): array
    {
        return [
            ['123459318019'],
            ['012345'],
            ['9809aamvoekd'],
            ['０１２３４５']
        ];
    }

    /**
     * @test
     * @dataProvider invalidMax5OfCharacterNumbers
     */
    public function invalidMaxOfCharacterNumbers(string $invalidNumber)
    {
        $config = new ValidatorConfig('5文字いないの数字を入力してください。');
        $config->setMaxLength(5);
        $validator = new NumValidator($config, $invalidNumber);
        $result = $validator->isValidate();
        $this->assertFalse($result->isValid());
        $this->assertSame($result->getReason(), '5文字いないの数字を入力してください。');
    }

    public function validMin5OfCharacterNumbers(): array
    {
        return [
            ['12345493850'],
            ['000000000'],
            ['01234'],
        ];
    }

    /**
     * @test
     * @dataProvider validMin5OfCharacterNumbers
     */
    public function validMinOfCharacterNumbers(string $validNumber)
    {
        $config = new ValidatorConfig('5文字以上の数字を入力してください。');
        $config->setMinLength(5);
        $validator = new NumValidator($config, $validNumber);
        $result = $validator->isValidate();
        $this->assertTrue($result->isValid());
    }

    public function invalidMin5OfCharacterNumbers(): array
    {
        return [
            ['1234'],
            ['0000'],
            ['0123'],
            ['１２３'],
            ['aboscddd']
        ];
    }
  

    /**
     * @test
     * @dataProvider invalidMin5OfCharacterNumbers
     */
    public function invalidMinOfCharacterNumbers(string $invalidNumber)
    {
        $config = new ValidatorConfig('5文字以上の数字を入力してください。');
        $config->setMinLength(5);
        $validator = new NumValidator($config, $invalidNumber);
        $result = $validator->isValidate();
        $this->assertFalse($result->isValid());
    }

    public function validMax5AndMin3OfCharacterNumbers(): array
    {
        return [
            ['123'],
            ['0000'],
            ['0123４'],
            ['１２３'],
            ['01234']
        ];
    }

    /**
     * @test
     * @dataProvider validMax5AndMin3OfCharacterNumbers
     */
    public function validMaxAndMinOfCharacterNumbers(string $validNumber)
    {
        $config = new ValidatorConfig('3文字以上、5文字以内の数字を入力してください。');
        $config->setMinLength(3);
        $config->setMaxLength(5);
        $validator = new NumValidator($config, $validNumber);
        $result = $validator->isValidate();
        $this->assertTrue($result->isValid());
    }


    public function invalidMax5AndMin3OfCharacterNumbers(): array
    {
        return [
            ['123aa'],
            ['000000'],
            ['0123４444'],
            ['１'],
            ['01']
        ];
    }

    /**
     * @test
     * @dataProvider invalidMax5AndMin3OfCharacterNumbers
     */
    public function invalidMaxAndMinOfCharacterNumbers(string $invalidNumber)
    {
        $config = new ValidatorConfig('3文字以上、5文字以内の数字を入力してください。');
        $config->setMinLength(3);
        $config->setMaxLength(5);
        $validator = new NumValidator($config, $invalidNumber);
        $result = $validator->isValidate();
        $this->assertFalse($result->isValid());
    }
    

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function testConfigExpect()
    {
        $config = new ValidatorConfig('なんかだめ');
        $config->setCharWidth('aaa');
    }

        // $config = new ValidatorConfig(Validate::NUMBER, CharWidth::En);
        // $validator = new Validator($config, '123');
        // $result = $validator->isValidate();
        // $this->assertTrue($result->isValid());
}