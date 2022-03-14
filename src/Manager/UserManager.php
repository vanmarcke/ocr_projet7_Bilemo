<?php

namespace App\Manager;

use App\Entity\Clients;
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
}
