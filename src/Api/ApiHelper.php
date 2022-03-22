<?php

namespace App\Api;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiHelper
{
    public function __construct(private SerializerInterface $serializer)
    {
    }

    /**
     * Method createSerialization.
     *
     * @param array $groups  Determine serialization by groups
     * @param bool  $isItems If true, serialization by Items (get/id)
     */
    public function createSerialization(array $groups, bool $isItems)
    {
        $context = SerializationContext::create();
        if ($isItems) {
            return $context->setGroups(['Default', 'items' => $groups]);
        }

        return $context->setGroups($groups);
    }

    /**
     * Method badRequest.
     *
     * @param array $errors Contains error elements
     *
     * @return JsonResponse Returns code 400 message
     */
    public function badRequest(array $errors): JsonResponse
    {
        return new jsonResponse($errors, Response::HTTP_BAD_REQUEST, []);
    }

    /**
     * Method response.
     *
     * @param array $value Contains error elements
     * @param int   $code  Contains the error code
     *
     * @return JsonResponse Returns errors and code message
     */
    public function response(array $value, int $code): JsonResponse
    {
        return new JsonResponse(json_encode($value), $code, [], true);
    }
}
