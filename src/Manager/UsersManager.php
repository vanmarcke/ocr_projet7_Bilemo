<?php

namespace App\Manager;

use App\Entity\Clients;
use App\Repository\UsersRepository;
use Doctrine\ORM\Query;

class UsersManager implements UsersManagerInterface
{
    public function __construct(private UsersRepository $usersRepo)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getUsersList(Clients $client): Query
    {
        return $this->usersRepo->findByClient($client);
    }


}