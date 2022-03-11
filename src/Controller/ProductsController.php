<?php

namespace App\Controller;

use App\Api\PaginatorApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use App\Entity\Products;
use App\Manager\ProductsManagerInterface;
use App\Repository\ProductsRepository;

class ProductsController extends AbstractController
{
    public function __construct(private SerializerInterface $serializer, private ProductsManagerInterface $productManager, private PaginatorApi $paginatorApi)
    {
    }
    
    /**
     * @OA\Response(
     *     response=200,
     *     description="Returns Products collection (paginated)",
     *     @OA\JsonContent(
     *     )
     * )
     *
     * @OA\Parameter(
     *     name="page",
     *     in="query",
     *     description="Page you need (leave empty if you want the first one)",
     *     @OA\Schema(type="int")
     * )
     *
     * @OA\Tag(name="Products")
     *
     */
    #[Route('/api/products', methods:['GET'], name: 'products_show')]
    public function showProducts(Request $request): JsonResponse
    {
        $productsList = $this->productManager->getProductsList($request);

        $productsList = $this->paginatorApi->paginate(
            $request,
            $productsList
        );

        $this->serializer->serialize($productsList, 'json', ['groups' => 'show_products']);

        return $this->json($productsList, Response::HTTP_OK);
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Returns Product Entity",
     *     @OA\JsonContent(
     *          type="array",
     *          @OA\Items(ref=@Model(type=Products::class, groups={"product"}))
     *     )
     * )
     * 
     * @OA\Tag(name="Products")
     * 
     */
    #[Route('/api/products/{id}', methods:['GET'], name: 'product_show')]
    public function showProduct($id)
    {
        $product = $this->productManager->getProductId($id);

        $this->serializer->serialize($product, 'json', ['groups' => 'product']);

        return $this->json($product, Response::HTTP_OK);
    }
}
