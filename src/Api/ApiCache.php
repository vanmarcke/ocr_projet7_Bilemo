<?php

namespace App\Api;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiCache
{
    /**
     * Method cache.
     *
     * @param JsonResponse $jsonResponse Caching parameter
     */
    public function cache(JsonResponse $jsonResponse): JsonResponse
    {
        $jsonResponse->setPublic();
        $jsonResponse->setSharedMaxAge(3600);

        $jsonResponse->headers->addCacheControlDirective('must-revalidate', true);

        return $jsonResponse;
    }
}
