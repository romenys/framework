<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 03/12/16
 * Time: 17:51
 */

namespace Romenys\Framework\Components;


class Model implements ModelInterface
{
    public function __construct($data = [])
    {
        if (!empty($data)) $this->hydrate($data);

        if (method_exists($this, "setCreated_at") && empty($data["created_at"])) $this->setCreated_at("NOW");
    }

    public function hydrate(array $data)
    {
        foreach ($data as $name => $value) {
            $method = 'set'.ucfirst($name);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * Transform actual object to array. Only "public" or "protected" properties will be created as array
     *
     * @param null|array|object $data
     *
     * @return array|null
     */
    public function toArray($data = null)
    {
        $data = is_null($data) ? $this : $data;

        if (is_array($data) || is_object($data)) {
            $result = array();

            foreach ($data as $key => $value) {
                if (is_object($value))
                    $result[$key] = $this->toArray($value);
                else
                    $result[$key] = $value;
            }

            return $result;
        }

        return $data;
    }
}
