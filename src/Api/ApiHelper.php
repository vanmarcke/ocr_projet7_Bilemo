<?php

namespace App\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiHelper
{
    /**
     * Method notFoundResponse.
     *
     * @return JsonResponse Returns 404 error message
     */
    public function notFoundResponse(): JsonResponse
    {
        $error = json_encode([
            'error' => 'data not found',
        ]);

        return new JsonResponse($error, Response::HTTP_NOT_FOUND, [], true);
    }
}
