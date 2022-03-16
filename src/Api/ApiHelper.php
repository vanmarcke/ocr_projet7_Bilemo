<?php

namespace App\Api;

use Symfony\Component\HttpFoundation\Response;

class ApiHelper
{
    /**
     * Method notFoundResponse.
     *
     * @return Response Returns 404 error message
     */
    public function notFoundResponse(): Response
    {
        $error = json_encode([
            'error' => 'data not found',
        ]);

        return new Response($error, Response::HTTP_NOT_FOUND, [
            'Content-Type' => 'application/json',
        ]);
    }
}
