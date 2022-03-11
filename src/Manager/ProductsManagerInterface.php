<?php

namespace App\Manager;

use App\Entity\Products;

interface ProductsManagerInterface
{
    /**
     * Method getProductsList Contains products information
     *
     * @return array<products>
     */
    public function getProductsList(): array;
}
