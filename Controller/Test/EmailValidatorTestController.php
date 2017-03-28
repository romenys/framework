<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 03/01/17
 * Time: 11:10
 */

namespace PhpLight\Framework\Controller\Test;
use PhpLight\Framework\Controller\Controller;

use PhpLight\Http\Request\Request;
use PhpLight\Framework\Validator\Validators\EmailValidator;
class EmailValidatorTestController extends Controller
{
    public function validatorEmailAction(Request $request)
    {
        $emailValidator = new EmailValidator('asdf@sdf');
        dump(!$emailValidator->isValid());

        $emailValidator = new EmailValidator('faefaez.fvrsfe@feqfqez.fr');
        dump($emailValidator->isValid());

        $emailValidator = new EmailValidator('vfsvsfds@rrfeqdf.com');
        dump($emailValidator->isValid());

        $emailValidator = new EmailValidator('vefqfqef.gvrqeqfez');
        dump(!$emailValidator->isValid());

        $emailValidator = new EmailValidator('vefqfqef');
        dump(!$emailValidator->isValid());

        $emailValidator = new EmailValidator('vefqfqef@@fdqfezd.com');
        dump(!$emailValidator->isValid());

        $emailValidator = new EmailValidator('vefqfqef@fdqfezd..com');
        dump(!$emailValidator->isValid());

        $emailValidator = new EmailValidator('vefq-fqef@fdqfezd.com');
        dump($emailValidator->isValid());

        $emailValidator = new EmailValidator('vefqf15qef@fdqfezd.com');
        dump($emailValidator->isValid());

        $emailValidator = new EmailValidator('vefqfqef@fdqfe26zd.com');
        dump($emailValidator->isValid());

        $emailValidator = new EmailValidator('vefq fqef@fdqfezd.com');
        dump(!$emailValidator->isValid());

        $emailValidator = new EmailValidator('  vefqfqef@fdqfezd.com');
        dump($emailValidator->isValid());

        $emailValidator = new EmailValidator('vefqfqef@fdqfezd.com  ');
        dump($emailValidator->isValid());

        $emailValidator = new EmailValidator('@vdqvddcq.com');
        dump(!$emailValidator->isValid());

        $emailValidator = new EmailValidator('fdqfe.com');
        dump(!$emailValidator->isValid());

        $errors = [];
        if (!$emailValidator->isValid()) $errors = $emailValidator->getErrors();

        //$emailValidator = new OnlyBnpEmailValidator('khalid.sookia@bnpparibas.com');
    }
}
