<?php

namespace App\polygons;

class Rectangle
{
    protected $width;
    protected $heigth;

    /**
     * Get the value of width
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * Set the value of width
     *
     * @return  self
     */
    public function setWidth(float $width): void
    {
        $this->width = $width;
    }

    /**
     * Get the value of heigth
     */
    public function getHeigth(): float
    {
        return $this->heigth;
    }

    /**
     * Set the value of heigth
     *
     * @return  self
     */
    public function setHeigth(float $heigth): void
    {
        $this->heigth = $heigth;
    }
}
