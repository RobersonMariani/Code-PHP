<?php

namespace App;

use App\ShoppingCart;

class Order
{
    private $status;
    private $shoppingCart;
    private $orderValue;

    public function __construct()
    {
        $this->status = "Aberto";
        $this->shoppingCart = new  ShoppingCart();
    }


    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the value of shoppingCart
     */
    public function getShoppingCart()
    {
        return $this->shoppingCart;
    }

    /**
     * Get the value of orderValue
     */
    public function getOrderValue()
    {
        return $this->orderValue;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus(string $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Set the value of shoppingCart
     *
     * @return  self
     */
    public function setShoppingCart($shoppingCart)
    {
        $this->shoppingCart = $shoppingCart;

        return $this;
    }

    /**
     * Set the value of orderValue
     *
     * @return  self
     */
    public function setOrderValue($orderValue)
    {
        $this->orderValue = $orderValue;

        return $this;
    }

    public function confirm()
    {
        if ($this->shoppingCart->cartValidate()) {
            $this->setStatus('confirmado');
            return true;
        } else {
            return false;
        }
    }
}
