<?php

namespace App\Manager;

use App\Entity\Clients;
use Doctrine\ORM\Query;

interface UsersManagerInterface
{
    /**
     * Method getUsersList Contains users information.
     */
    public function getUsersList(Clients $client): Query;
}
