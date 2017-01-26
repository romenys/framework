<?php

namespace Romenys\Framework\Validator;

Interface ValidatorInterface
{
    /**
     * @return mixed
     */
    public function isValid();

    /**
     * @return mixed
     */
    public function getErrors();
}