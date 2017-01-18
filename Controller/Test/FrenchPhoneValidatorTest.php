<?php

use Romenys\Framework\Validator\Validators\FrenchPhoneValidator;


class FrenchPhoneValidatorTest extends PHPUnit_Framework_TestCase
{
    public function testValidateFrenchPhoneNumber()
    {
        $phoneValidator = new FrenchPhoneValidator('99-23.45.67-89');
        $this->assertTrue(!$phoneValidator->isValid());

        $phoneValidator = new FrenchPhoneValidator('+33 9-23.45.67-89');
        $this->assertTrue($phoneValidator->isValid());

        $phoneValidator = new FrenchPhoneValidator('+33 2-23.45.67-89');
        $this->assertTrue($phoneValidator->isValid());

        $phoneValidator = new FrenchPhoneValidator('+33 99-23.45.67-89');
        $this->assertTrue(!$phoneValidator->isValid());

        $phoneValidator = new FrenchPhoneValidator('+339923456789');
        $this->assertTrue(!$phoneValidator->isValid());
    }
}