<?php

namespace App\Manager;

use App\Entity\Clients;
use App\Entity\Users;
use App\Repository\UsersRepository;

class UsersManager implements UsersManagerInterface
{
    public function __construct(private UsersRepository $usersRepo)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getUsersList($client)
    {
        return $this->usersRepo->findByClient($client);
    }

    /**
     * {@inheritdoc}
     */
    public function getUserId($client, $id)
    {
        return $this->usersRepo->findOneByClient($client, $id);
    }
}
