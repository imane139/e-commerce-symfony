<?php

namespace App\Controller;

use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    public function __construct(
        private ProductService $productService
    ) {}

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $products = $this->productService->getAllProducts();

        return $this->render('shop/index.html.twig', [
            'products' => $products,
        ]);
    }
}
