<?php

namespace App\Manager;

use App\Api\PaginatorApi;
use App\Entity\Products;
use App\Repository\ProductsRepository;

class ProductsManager implements ProductsManagerInterface
{
    public function __construct(private ProductsRepository $productsRepo)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getProductsList(): array
    {
        return $this->productsRepo->ProductsFindAll();
    }
}