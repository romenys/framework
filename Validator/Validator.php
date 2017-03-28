<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 02/01/17
 * Time: 10:24
 */

namespace PhpLight\Framework\Validator;

class Validator
{
    /**
     * @var string
     */
    private $data;

    /**
     * @var array
     */
    private $params;

    /**
     * @var bool
     */
    private $valid = false;

    /**
     * @var array
     */
    private $errors;

    protected function __construct($data, $params = null)
    {
        if (empty($data)) throw new \Exception("Data must be a real string and not empty");

        $this->setData($data);
        $this->setParams($params);
    }

    /**
     * @return string
     */
    protected function getData()
    {
        return $this->data;
    }

    /**
     * @param string $data
     *
     * @return Validator
     */
    protected function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return array
     */
    protected function getParams()
    {
        return $this->params;
    }

    /**
     * @param array $params
     *
     * @return Validator
     */
    protected function setParams($params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isValid()
    {
        return $this->valid;
    }

    /**
     * @param boolean $valid
     *
     * @return Validator
     */
    protected function setValid($valid)
    {
        $this->valid = $valid;

        return $this;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     *
     * @return Validator
     */
    protected function setErrors($errors)
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * @param string
     *
     * @return Validator
     */
    protected function addErrors($error)
    {
        $this->errors[] = $error;

        return $this;
    }
}
