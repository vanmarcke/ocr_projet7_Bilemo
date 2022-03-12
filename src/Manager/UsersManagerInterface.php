<?php

namespace App\Manager;

use App\Entity\Users;

interface UsersManagerInterface
{
    /**
     * Method getUsersList. contains users information.
     *
     * @param $client reference to identified client ID
     */
    public function getUsersList($client);

    /**
     * Method getUserId. Contains user information / id.
     *
     * @param $client Reference to identified client ID
     * @param $id Reference to Requested Id
     */
    public function getUserId($client, $id);
}
