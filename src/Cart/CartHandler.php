<?php

namespace App\Cart;

class CartHandler
{
    public function handle(Cart $cart, CartInterface $strategy): Cart
    {
        return $strategy->getCart($cart->getId());
    }
}
