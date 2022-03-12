<?php

namespace App\Manager;

use App\Entity\Clients;

interface UsersManagerInterface
{
    /**
     * Method getUsersList Contains users information.
     */
    public function getUsersList(Clients $client);
}
