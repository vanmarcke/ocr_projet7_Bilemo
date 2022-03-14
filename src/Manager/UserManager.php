<?php

namespace App\Manager;

use App\Entity\Clients;
use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\ORM\Query;

class UserManager implements UsersManagerInterface
{
    public function __construct(private UsersRepository $usersRepo)
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
    public function getUserId(Clients $client, int $id)
    {
        return $this->usersRepo->findOneByClient($client, $id);
    }
}
