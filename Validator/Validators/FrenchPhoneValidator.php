<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 03/01/17
 * Time: 09:35
 */

namespace PhpLight\Framework\Validator\Validators;

use PhpLight\Framework\Validator\Validator;

class FrenchPhoneValidator extends Validator
{
    public function __construct($data, $params = null)
    {
        parent::__construct($data, $params);

        $this->validateFrenchPhoneNumber();
    }

    protected function validateFrenchPhoneNumber()
    {
        $number = preg_replace('/ /', '', trim($this->getData()));

        if (preg_match('/^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/', $number)) {
            $this->setValid(true);
        } else {
            $this->setValid(false);
            $this->addErrors("Le numéro de téléphone est invalid");
        }
    }
}
