<?php

namespace App\Controller;

use App\Manager\ProductsManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProductsController extends AbstractController
{
    public function __construct(private SerializerInterface $serializer, private ProductsManagerInterface $productManager)
    {
    }

    #[Route('/api/products', methods:['GET'], name: 'products_show')]
    public function showProducts(): JsonResponse
    {
        $productsList = $this->productManager->getProductsList();

        $this->serializer->serialize($productsList, 'json', ['groups' => 'show_products']);

        return $this->json($productsList, Response::HTTP_OK);
    }
}
