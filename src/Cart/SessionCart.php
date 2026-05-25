<?php

namespace App\Cart;

use Symfony\Component\HttpFoundation\RequestStack;

class SessionCart implements CartInterface
{
    private $session;

    public function __construct(RequestStack $requestStack)
    {
        $this->session = $requestStack->getSession();
    }

    public function getCart(string $identifier): Cart
    {
        // Récupère le panier depuis la session
        // S'il n'existe pas, en crée un nouveau
        $cart = $this->session->get($identifier);

        if (!$cart instanceof Cart) {
            $cart = new Cart($identifier);
        }

        return $cart;
    }

    public function add(CartItem $item, Cart $cart): Cart
    {
        $cartItems = $cart->getCartItems();

        // Vérifie si le produit existe déjà dans le panier
        foreach ($cartItems as $cartItem) {
            if ($cartItem->getProduct()->getId() === $item->getProduct()->getId()) {
                // Augmente juste la quantité
                $cartItem->setQuantity($cartItem->getQuantity() + $item->getQuantity());
                $this->session->set($cart->getId(), $cart);
                return $cart;
            }
        }

        // Sinon ajoute le nouvel article
        $cart->addCartItem($item);
        $this->session->set($cart->getId(), $cart);

        return $cart;
    }

    public function remove(CartItem $item, Cart $cart): Cart
    {
        $cartItems = $cart->getCartItems();

        $newItems = array_filter($cartItems, function (CartItem $cartItem) use ($item) {
            return $cartItem->getProduct()->getId() !== $item->getProduct()->getId();
        });

        $cart->setCartItems(array_values($newItems));
        $this->session->set($cart->getId(), $cart);

        return $cart;
    }

    public function clearCart(string $identifier): void
    {
        $this->session->remove($identifier);
    }
}
