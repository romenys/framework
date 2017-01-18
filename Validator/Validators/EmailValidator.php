<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 02/01/17
 * Time: 10:42
 */

namespace Romenys\Framework\Validator\Validators;

use Romenys\Framework\Validator\Validator;

class EmailValidator extends Validator
{
    /**
     * EmailValidator constructor.
     * @param $data
     * @param null|array $params
     * @desc $params takes an array of ["validator"]["error"]["emailFormat"]
     */
    public function __construct($data, $params = null)
    {
        parent::__construct($data, $params);
        $this->validateEmail($data, $params);
    }

    protected function validateEmail($data, $params = null)
    {
        if(filter_var(trim($data), FILTER_VALIDATE_EMAIL)) {
            $this->setValid(true);
        } else {
            $error = isset($params["validator"]["error"]["emailFormat"]) ? $params["validator"]["error"]["emailFormat"] : "L'adresse mail n'est pas valide. Il y a probablement une erreur de syntaxe";

            $this->setValid(false);
            $this->addErrors($error);
        }
    }
}
