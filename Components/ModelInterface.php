<?php

namespace PhpLight\Framework\Components;

Interface ModelInterface
{
    /**
     * Hydrate the current object
     * @param array $data
     * @return mixed
     */
    public function hydrate(array $data);

    /**
     * Transform actual object to array. Only "public" or "protected" properties will be created as array
     * @param array $data
     * @return mixed
     */
    public function toArray($data = null);
}