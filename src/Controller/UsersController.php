<?php

namespace App\Controller;

use App\Api\ApiHelper;
use App\Api\FormHelper;
use App\Manager\UsersManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Entity\Users;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use Knp\Component\Pager\PaginatorInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class UsersController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em, private ApiHelper $apiHelper, private SerializerInterface $serializer, private UsersManagerInterface $usersManager, private PaginatorInterface $paginator)
    {
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Returns Users collection (paginated)",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=Users::class, groups={"show_users"}))
     *     )
     * )
     *
     * @OA\Parameter(
     *     name="page",
     *     in="query",
     *     description="Page you need (leave empty if you want the first one)",
     *     @OA\Schema(type="int")
     * )
     *
     * @OA\Tag(name="Users")
     */
    #[Route('/api/users', methods: ['GET'], name: 'users_show')]
    public function showUsers(Request $request): JsonResponse
    {
        $client = $this->getUser();

        $users = $this->usersManager->getUserList($client);

        $usersList = $this->paginator->paginate($users, $request->query->getInt('page', 1), 10);

        // $json = $this->serializer->serialize($usersList, 'json', SerializationContext::create()->setGroups(array('show_users')));

        $json = $this->serializer->serialize($usersList, 'json');

        return new jsonResponse($json, Response::HTTP_OK, [], true);
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Returns Users entity",
     *     @OA\JsonContent(
     *          type="array",
     *          @OA\Items(ref=@Model(type=Users::class, groups={"user"}))
     *     )
     * )
     *
     * @OA\Tag(name="Users")
     */
    #[Route('/api/users/{id}', methods: ['GET'], name: 'user_show')]
    public function showUser(int $id): JsonResponse
    {
        $client = $this->getUser();

        $user = $this->usersManager->getUserId($client, $id);

        if (null !== $user) {
            $json = $this->serializer->serialize($user, 'json', SerializationContext::create()->setGroups('user'));

            return new jsonResponse($json, Response::HTTP_OK, [], true);
        }

        return $this->apiHelper->notFoundResponse();
    }

    #[Route('/api/users', methods: ['POST'], name: 'user_add')]
    public function postUser(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $client = $this->getUser();
        $user = (new Users())->setClients($client);

        $userForm = $this->createForm(UserType::class, $user);
        $userForm->submit($data);

        if ($userForm->isValid()) {
            $this->em->persist($user);
            $this->em->flush();
            $user = $this->apiHelper->serializeUser($user);

            return $this->apiHelper->createdResponse($user);
        } else {
            $errors = FormHelper::getErrors($userForm);

            return $this->apiHelper->badRequest($errors);
        }
    }

    #[Route('/api/users/{id}', methods: ['PUT'], name: 'user_patch')]
    public function patchUser($id, Request $request)
    {
        $client = $this->getUser();
        $user = $this->usersManager->getUserId($client, $id);

        if (!empty($user)) {
            $data = json_decode($request->getContent(), true);
            $checker = FormHelper::checkFields($data);
            if (!empty($checker)) {
                return $this->apiHelper->badRequest($checker);
            }
            $client = $this->getUser();

            $userForm = $this->createForm(UserType::class, $user);
            $userForm->submit($data, false);
            if ($userForm->isValid()) {
                $this->em->persist($user);
                $this->em->flush();
                $user = $this->apiHelper->serializeUser($user);

                return $this->apiHelper->updatedResponse($user);
            } else {
                $errors = FormHelper::getErrors($userForm);

                return $this->apiHelper->response($errors, 400);
            }
        }

        return $this->apiHelper->notFoundResponse();
    }
}
