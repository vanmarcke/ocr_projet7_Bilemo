<?php

namespace App\Controller;

use App\Api\PaginatorApi;
use App\Manager\UsersManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class UsersController extends AbstractController
{
    public function __construct(private SerializerInterface $serializer, private UsersManagerInterface $usersManager, private PaginatorApi $paginatorApi)
    {
    }

    #[Route('/api/users', methods: ['GET'], name: 'users_show')]
    public function showUsers(Request $request): JsonResponse
    {
        $client = $this->getUser();

        $usersList = $this->usersManager->getUserList($client);

        $usersList = $this->paginatorApi->paginate(
            $request,
            $usersList
        );

        $this->serializer->serialize($usersList, 'json', ['groups' => 'show_users']);

        return $this->json($usersList, Response::HTTP_OK);
    }

    #[Route('/api/users/{id}', methods: ['GET'], name: 'user_show')]
    public function showUser($id): JsonResponse
    {
        $client = $this->getUser();

        $user = $this->usersManager->getUserId($client, $id);

        if (null != $user) {
            $this->serializer->serialize($user, 'json', ['groups' => 'user']);

            return $this->json($user, Response::HTTP_OK);
        }

        return $this->json($user, Response::HTTP_NOT_FOUND);
    }
}
