<?php

namespace App\Cart;

use App\Entity\Product;

class CartItem
{
    private int $quantity;
    private float $price;
    private Product $product;

    public function __construct(Product $product, int $quantity = 1)
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->price = (float) $product->getPrice();
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getTotal(): float
    {
        return $this->price * $this->quantity;
    }
}
