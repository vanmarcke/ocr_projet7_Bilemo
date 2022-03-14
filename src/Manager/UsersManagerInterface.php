<?php

namespace App\Manager;

use App\Entity\Clients;
use Doctrine\ORM\Query;

interface UsersManagerInterface
{
    /**
     * Method getUserList.
     *
     * @param Clients $client contains users information
     */
    public function getUserList(Clients $client): Query;
}
