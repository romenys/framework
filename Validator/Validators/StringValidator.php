<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 04/01/17
 * Time: 00:47
 */

namespace PhpLight\Framework\Validator\Validators;

use PhpLight\Framework\Validator\Validator;

class StringValidator extends Validator
{
    /**
     * StringValidator constructor.
     * @param string $data
     * @param array [$params]
     * @desc $params must have at least 1 of the following
     *          [constraints][minLength] => int
     *          [constraints][maxLength] => int
     *          [constraints][alphaOnly] => bool | if set to true spaces are allowed else space will throw an error.
     */
    public function __construct($data, $params = null)
    {
        parent::__construct($data, $params);

        $this->validateString();
    }

    protected function validateString()
    {
        if (!is_string($this->getData())) throw new \Exception('$data must be a string');

        if (!isset($this->getParams()["constraints"]) || empty($this->getParams()["constraints"]))
            throw new \Exception('$params must have at least 1 constraint');

        $this->setValid(true);

        foreach ($this->getParams()["constraints"] as $constraint => $value) {
            $constraint = $constraint . 'Strategy';

            if (!method_exists($this, $constraint)) throw new \Exception("The method $constraint does not exist");

            $this->$constraint($value);
        }
    }

    protected function minLengthStrategy($value)
    {
        if (!is_int((int) $value)) throw new \Exception("The value of minLength must be an int. " . gettype($value) . " given.");

        if (strlen($this->getData()) < $value) {
            $this->setValid(false);
            $this->addErrors("Vous devez saisir au moins $value caractères");
        }
    }

    protected function maxLengthStrategy($value)
    {
        if (!is_int((int) $value)) throw new \Exception("The value of maxLength must be an int. " . gettype($value) . " given.");

        if (strlen($this->getData()) > (int) $value) {
            $this->setValid(false);
            $this->addErrors("Maximum de $value caractères autorisé");
        }
    }

    protected function alphaOnlyStrategy($value)
    {
        if ($value) {
            $this->setData(preg_replace('/ /', '', $this->getData()));
        }

        setLocale(LC_CTYPE, 'FR_fr.UTF-8');

        if (!ctype_alpha($this->getData())) {
            $this->setValid(false);
            $this->addErrors("Seul les caractères alpha (A-Za-z) sont autorisé");
        }
    }
}
