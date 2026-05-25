<?php

namespace App\Cart;

class ApiCart implements CartInterface
{
    public function getCart(string $identifier): Cart
    {
        dd('ApiCart::getCart appelé', $identifier);
    }

    public function add(CartItem $item, Cart $cart): Cart
    {
        dd('ApiCart::add appelé', $item, $cart);
    }

    public function remove(CartItem $item, Cart $cart): Cart
    {
        dd('ApiCart::remove appelé', $item, $cart);
    }

    public function clearCart(string $identifier): void
    {
        dd('ApiCart::clearCart appelé', $identifier);
    }
}
