<?php

namespace App;

class Item
{
    private $description;
    private $value;

    public function __construct()
    {
        $this->description = '';
        $this->value       = 0;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the value of value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Set the value of value
     *
     * @return  self
     */
    public function setValue(float $value)
    {
        $this->value = $value;

        return $this;
    }

    public function validateItem()
    {
        if ($this->description == "") return false;
        if ($this->value <= 0) return false;

        return true;
    }
}
