<?php

namespace App;

class Polygon
{
    private $shape;

    /**
     * Get the value of shape
     */
    public function getShape(): object
    {
        return $this->shape;
    }

    /**
     * Set the value of shape
     *
     * @return  self
     */
    public function setShape(object $shape): void
    {
        $this->shape = $shape;
    }

    public function getArea(): float
    {
        return $this->getShape()->getWidth() * $this->getShape()->getHeigth();
    }
}
