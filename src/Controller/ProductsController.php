<?php

namespace App\Controller;

use App\Api\ApiHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Entity\Products;
use App\Manager\ProductsManagerInterface;
use JMS\Serializer\SerializerInterface;
use Knp\Component\Pager\PaginatorInterface;

class ProductsController extends AbstractController
{
    public function __construct(private ApiHelper $apiHelper, private SerializerInterface $serializer, private ProductsManagerInterface $productManager, private PaginatorInterface $paginator)
    {
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Returns Products collection (paginated)",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=Products::class))
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
     */
    #[Route('/api/products', methods: ['GET'], name: 'products_show')]
    public function showProducts(Request $request): Response
    {
        $products = $this->productManager->getProductsList();

        $productsList = $this->paginator->paginate($products, $request->query->getInt('page', 1), 10);

        $json = $this->serializer->serialize($productsList, 'json');

        return new Response($json, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Returns Product Entity",
     *     @OA\JsonContent(
     *          type="array",
     *          @OA\Items(ref=@Model(type=Products::class))
     *     )
     * )
     *
     * @OA\Tag(name="Products")
     */
    #[Route('/api/products/{id}', methods: ['GET'], name: 'product_show', requirements: ['id' => '\d+'])]
    public function showProduct(int $id): Response
    {
        $product = $this->productManager->getProductId($id);

        if (null !== $product) {
            $json = $this->serializer->serialize($product, 'json');

            return new Response($json, Response::HTTP_OK, ['Content-Type' => 'application/json']);
        }

        return $this->apiHelper->notFoundResponse();
    }
}
