<?php

namespace App\Manager;

use App\Entity\Clients;
use App\Entity\Users;
use Doctrine\ORM\Query;

interface UsersManagerInterface
{
    /**
     * Method getUserList.
     *
     * @param Clients $client contains users information
     */
    public function getUserList(Clients $client): Query;

    /**
     * Method getUserId. Contains user information / id.
     *
     * @param Clients $client Reference to identified client ID
     * @param int     $id     Reference to Requested Id
     */
    public function getUserId(Clients $client, int $id): ?Users;

    /**
     * Method removeUser.
     *
     * @param Users $user contains user information
     */
    public function removeUser(Users $user): void;

    /**
     * Method removeUser.
     *
     * @param Users $user contains user information
     */
    public function addUser(Users $user): Users;

    /**
     * Method updateUser.
     *
     * @param Users $user contains user information
     */
    public function updateUser(Users $user): Users;
}
