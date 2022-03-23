<?php

namespace App\Controller;

use App\Api\ApiCache;
use App\Api\ApiHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Entity\Products;
use App\Manager\ProductsManagerInterface;
use JMS\Serializer\SerializerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ProductsController extends AbstractController
{
    public function __construct(private ApiCache $apicache, private ApiHelper $apiHelper, private SerializerInterface $serializer, private ProductsManagerInterface $productManager, private PaginatorInterface $paginator)
    {
    }

    /**
     * View all available products.
     *
     * @OA\Response(
     *     response=200,
     *     description="Returns Products collection (paginated)",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=Products::class, groups={"show_products"}))
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
    public function showProducts(Request $request): JsonResponse
    {
        $products = $this->productManager->getProductsList();

        $productsList = $this->paginator->paginate($products, $request->query->getInt('page', 1), 10);

        $json = $this->serializer->serialize(
            $productsList,
            'json',
            $this->apiHelper->createSerialization(['show_products'], true)
        );

        $response = JsonResponse::fromJsonString($json, Response::HTTP_OK);

        return $this->apicache->cache($response);
    }

    /**
     * View an available product.
     *
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
     */
    #[Route('/api/products/{id}', methods: ['GET'], name: 'product_show', requirements: ['id' => '\d+'])]
    public function showProduct(int $id): JsonResponse
    {
        $product = $this->productManager->getProductId($id);

        if (null !== $product) {
            $json = $this->serializer->serialize(
                $product,
                'json',
                $this->apiHelper->createSerialization(['product'], false)
            );

            $response = JsonResponse::fromJsonString($json, Response::HTTP_OK);

            return $this->apicache->cache($response);
        }

        throw new HttpException(404, 'Data Not Found');
    }
}
