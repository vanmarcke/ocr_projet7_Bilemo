<?php

namespace App\Manager;

use App\Entity\Products;

interface ProductsManagerInterface
{
    /**
     * Method getProductsList Contains products information.
     *
     * @return array<products>
     */
    public function getProductsList(): array;

    /**
     * Method getProductId Contains the information of a single product.
     *
     * @param $id Main product reference
     */
    public function getProductId($id);
}
