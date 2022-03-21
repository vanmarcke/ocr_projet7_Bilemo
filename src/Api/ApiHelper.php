<?php

namespace App\Api;

use App\Entity\Users;
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
     * Method serializeUser.
     *
     * @param Users $user Contains user values
     *
     * @return string Returns the values of the "user" group
     */
    public function serializeUser(Users $user): string
    {
        return $this->serializer->serialize($user, 'json', SerializationContext::create()->setGroups('user'));
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
