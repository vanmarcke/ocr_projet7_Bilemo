<?php

namespace App\Manager;


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
    public function getProductId($id): Products
    {
        return $this->productsRepo->findOneBy(["id" => $id]);
    }
}
