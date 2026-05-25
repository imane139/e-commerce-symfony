<?php

namespace App\Cart;

class Cart
{
    private string $id;
    private \DateTime $createdAt;
    /** @var CartItem[] */
    private array $cartItems = [];

    public function __construct(string $id)
    {
        $this->id = $id;
        $this->createdAt = new \DateTime();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getCartItems(): array
    {
        return $this->cartItems;
    }

    public function setCartItems(array $cartItems): void
    {
        $this->cartItems = $cartItems;
    }

    public function addCartItem(CartItem $cartItem): void
    {
        $this->cartItems[] = $cartItem;
    }

    public function total(): float
    {
        $total = 0;
        foreach ($this->cartItems as $item) {
            $total += $item->getTotal();
        }
        return $total;
    }
}
