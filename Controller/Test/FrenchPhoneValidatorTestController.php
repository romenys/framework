<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 03/01/17
 * Time: 10:55
 */

namespace PhpLight\Framework\Controller\Test;

use PhpLight\Framework\Controller\Controller;
use PhpLight\Framework\Validator\Validators\FrenchPhoneValidator;
use PhpLight\Http\Request\Request;

class FrenchPhoneValidatorTestController extends Controller
{
    public function validatorFrenchPhoneAction()
    {
        $phoneValidator = new FrenchPhoneValidator('01 23 45 67 89');
        dump($phoneValidator->isValid());

        $phoneValidator = new FrenchPhoneValidator('+33 1 23 45 67 89');
        dump($phoneValidator->isValid());

        $phoneValidator = new FrenchPhoneValidator('01.23.45.67.89');
        dump($phoneValidator->isValid());

        $phoneValidator = new FrenchPhoneValidator('01- 23- 45- 67- 89');
        dump($phoneValidator->isValid());

        $phoneValidator = new FrenchPhoneValidator('+331- 23. 45- 67- 89');
        dump($phoneValidator->isValid());

        $phoneValidator = new FrenchPhoneValidator('01-23.45.67-89');
        dump($phoneValidator->isValid());

        $phoneValidator = new FrenchPhoneValidator('02-23.45.67-89');
        dump($phoneValidator->isValid());

        $phoneValidator = new FrenchPhoneValidator('09-23.45.67-89');
        dump($phoneValidator->isValid());

        $phoneValidator = new FrenchPhoneValidator('99-23.45.67-89');
        dump(!$phoneValidator->isValid());

        $phoneValidator = new FrenchPhoneValidator('+33 9-23.45.67-89');
        dump($phoneValidator->isValid());

        $phoneValidator = new FrenchPhoneValidator('+33 2-23.45.67-89');
        dump($phoneValidator->isValid());

        $phoneValidator = new FrenchPhoneValidator('+33 99-23.45.67-89');
        dump(!$phoneValidator->isValid());

        $phoneValidator = new FrenchPhoneValidator('+339923456789');
        dump(!$phoneValidator->isValid());
    }
}
