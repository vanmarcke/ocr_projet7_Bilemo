<?php

namespace App\Controller;

use App\Api\PaginatorApi;
use App\Manager\ProductsManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProductsController extends AbstractController
{
    public function __construct(private SerializerInterface $serializer, private ProductsManagerInterface $productManager, private PaginatorApi $paginatorApi)
    {
    }

    #[Route('/api/products', methods:['GET'], name: 'products_show')]
    public function showProducts(Request $request): JsonResponse
    {
        $productsList = $this->productManager->getProductsList();

        $productsList = $this->paginatorApi->paginate(
            $request,
            $productsList
        );

        $this->serializer->serialize($productsList, 'json', ['groups' => 'show_products']);

        return $this->json($productsList, Response::HTTP_OK);
    }

    #[Route('/api/products/{id}', methods:['GET'], name: 'product_show')]
    public function showProduct(int $id)
    {
        $product = $this->productManager->getProductId($id);

        $this->serializer->serialize($product, 'json', ['groups' => 'product']);

        return $this->json($product, Response::HTTP_OK);
    }
}
