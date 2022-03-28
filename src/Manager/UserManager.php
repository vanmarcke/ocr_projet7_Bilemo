<?php

namespace App\Manager;

use App\Entity\Clients;
use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;

class UserManager implements UsersManagerInterface
{
    public function __construct(private EntityManagerInterface $em, private UsersRepository $usersRepo)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getUserList(Clients $client): Query
    {
        return $this->usersRepo->findByClient($client);
    }

    /**
     * {@inheritdoc}
     */
    public function getUserId(clients $client, int $id): ?Users
    {
        return $this->usersRepo->findOneByClient($client, $id);
    }

    /**
     * {@inheritdoc}
     */
    public function removeUser(Users $user): void
    {
        $this->em->remove($user);
        $this->em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function addUser(Users $user): Users
    {
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function updateUser(Users $user): Users
    {
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}
