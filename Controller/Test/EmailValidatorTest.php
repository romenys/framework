<?php

use PHPUnit\Framework\TestCase;
use Romenys\Framework\Validator\Validators\EmailValidator;

class EmailValidatorTest extends TestCase
{
    public function testValidateEmail()
    {
        $emailValidator = new EmailValidator('asdf@sdf');
        $this->assertTrue(!$emailValidator->isValid());

        $emailValidator = new EmailValidator('vefqfqef');
        $this->assertTrue(!$emailValidator->isValid());

        $emailValidator = new EmailValidator('vefqfqef.gvrqeqfez');
        $this->assertTrue(!$emailValidator->isValid());

        $emailValidator = new EmailValidator('vefqfqef@@fdqfezd.com');
        $this->assertTrue(!$emailValidator->isValid());

        $emailValidator = new EmailValidator('vefqfqef@fdqfezd..com');
        $this->assertTrue(!$emailValidator->isValid());

        $emailValidator = new EmailValidator('vefq fqef@fdqfezd.com');
        $this->assertTrue(!$emailValidator->isValid());

        $emailValidator = new EmailValidator('@vdqvddcq.com');
        $this->assertTrue(!$emailValidator->isValid());

        $emailValidator = new EmailValidator('fdqfe.com');
        $this->assertTrue(!$emailValidator->isValid());

        $emailValidator = new EmailValidator('faefaez.fvrsfe@feqfqez.fr');
        $this->assertTrue($emailValidator->isValid());

        $emailValidator = new EmailValidator('vfsvsfds@rrfeqdf.com');
        $this->assertTrue($emailValidator->isValid());

        $emailValidator = new EmailValidator('vefq-fqef@fdqfezd.com');
        $this->assertTrue($emailValidator->isValid());

        $emailValidator = new EmailValidator('vefqf15qef@fdqfezd.com');
        $this->assertTrue($emailValidator->isValid());

        $emailValidator = new EmailValidator('vefqfqef@fdqfe26zd.com');
        $this->assertTrue($emailValidator->isValid());

        $emailValidator = new EmailValidator('  vefqfqef@fdqfezd.com');
        $this->assertTrue($emailValidator->isValid());

        $emailValidator = new EmailValidator('vefqfqef@fdqfezd.com  ');
        $this->assertTrue($emailValidator->isValid());
    }
}