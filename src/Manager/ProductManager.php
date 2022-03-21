<?php

namespace App\Manager;

use App\Entity\Products;
use App\Repository\ProductsRepository;

class ProductManager implements ProductsManagerInterface
{
    public function __construct(private ProductsRepository $productsRepo)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getProductsList(): array
    {
        return $this->productsRepo->productsFindAll();
    }

    /**
     * {@inheritdoc}
     */
    public function getProductId(int $id)
    {
        return $this->productsRepo->findOneBy(['id' => $id]);
    }
}
