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
use Symfony\Component\HttpKernel\Exception\HttpException;

class UsersController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em, private ApiHelper $apiHelper, private SerializerInterface $serializer, private UsersManagerInterface $usersManager, private PaginatorInterface $paginator)
    {
    }

    /**
     * View all users assigned to a customer.
     *
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

        $json = $this->serializer->serialize($usersList, 'json');

        return JsonResponse::fromJsonString($json, Response::HTTP_OK);
    }

    /**
     * View a user assigned to a customer.
     *
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

            return JsonResponse::fromJsonString($json, Response::HTTP_OK);
        }

        throw new HttpException(404, 'Data Not Found');
    }

    /**
     * Add a user assigned to a customer.
     *
     * @OA\Response(
     *     response=201,
     *     description="Add User with all these informations",
     *     @OA\JsonContent(
     *     )
     * )
     *
     * @OA\RequestBody(
     *      @Model(type=Users::class, groups={"user_add"}))
     * )
     *
     * @OA\Tag(name="Users")
     */
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

            return JsonResponse::fromJsonString($user, Response::HTTP_CREATED);
        } else {
            $errors = FormHelper::getErrors($userForm);

            return $this->apiHelper->badRequest($errors);
        }
    }

    /**
     * Edit a user assigned to a customer.
     *
     * @OA\Response(
     *     response=200,
     *     description="Update User with all these informations",
     *     @OA\JsonContent(
     *          type="array",
     *          @OA\Items(ref=@Model(type=Users::class, groups={"user_add"}))
     *     )
     * )
     *
     * @OA\RequestBody(
     *      @Model(type=Users::class, groups={"user_add"}))
     * )
     *
     * @OA\Tag(name="Users")
     */
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

                return JsonResponse::fromJsonString($user, Response::HTTP_OK);
            } else {
                $errors = FormHelper::getErrors($userForm);

                return $this->apiHelper->response($errors, 400);
            }
        }

        throw new HttpException(404, 'Data Not Found');
    }

    /**
     * Delete a user assigned to a customer.
     *
     * @OA\Response(
     *     response=204,
     *     description="User deleted by id"
     * )
     *
     * @OA\Tag(name="Users")
     */
    #[Route('/api/users/{id}', methods: ['DELETE'], name: 'user_delete')]
    public function deleteUser($id)
    {
        $client = $this->getUser();

        $user = $this->usersManager->getUserId($client, $id);

        if (!empty($user)) {
            $user = $this->usersManager->removeUser($user);

            return JsonResponse::fromJsonString('', Response::HTTP_NO_CONTENT);
        }

        throw new HttpException(403, 'forbidden: you cannot do this action');
    }
}
