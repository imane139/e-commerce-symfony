<?php

namespace App\Controller;

use App\Cart\ApiCart;
use App\Cart\Cart;
use App\Cart\CartHandler;
use App\Cart\CartInterface;
use App\Cart\CartItem;
use App\Cart\SessionCart;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    public function __construct(
        #[Autowire(service: SessionCart::class)]
       // #[Autowire(service: ApiCart::class)]
        private CartInterface $cart,
        private CartHandler $cartHandler,
        private ProductService $productService
    ) {}

    #[Route('/cart', name: 'cart')]
    public function index(): Response
    {
        $cart = $this->cart->getCart('cart');

        return $this->render('shop/cart.html.twig', [
            'cart' => $cart,
        ]);
    }

    #[Route('/cart/add/{id}', name: 'cart_add')]
    public function add(int $id, Request $request): Response
    {
        $product = $this->productService->getProductById($id);

        if (!$product) {
            throw $this->createNotFoundException('Produit introuvable.');
        }

        $quantity = (int) $request->request->get('quantity', 1);
        $cart = $this->cart->getCart('cart');
        $cartItem = new CartItem($product, $quantity);
        $this->cart->add($cartItem, $cart);

        return $this->redirectToRoute('cart');
    }

    #[Route('/cart/remove/{id}', name: 'cart_remove')]
    public function remove(int $id): Response
    {
        $product = $this->productService->getProductById($id);

        if (!$product) {
            throw $this->createNotFoundException('Produit introuvable.');
        }

        $cart = $this->cart->getCart('cart');
        $cartItem = new CartItem($product);
        $this->cart->remove($cartItem, $cart);

        return $this->redirectToRoute('cart');
    }

    #[Route('/cart/clear', name: 'cart_clear')]
    public function clear(): Response
    {
        $this->cart->clearCart('cart');

        return $this->redirectToRoute('cart');
    }
}
