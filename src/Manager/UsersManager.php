<?php

namespace App\Manager;

use App\Entity\Clients;
use App\Repository\UsersRepository;

class UsersManager implements UsersManagerInterface
{
    public function __construct(private UsersRepository $usersRepo)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getUsersList(Clients $client)
    {
        return $this->usersRepo->findByClient($client);
    }
}
