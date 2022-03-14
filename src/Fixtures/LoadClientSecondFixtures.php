<?php

namespace App\Fixtures;

use App\Entity\Clients;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class LoadClientSecondFixtures extends Fixture
{
    public function __construct(protected UserPasswordHasherInterface $userPassword)
    {
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $clients = new Clients();
        $password = $this->userPassword->hashPassword($clients, '123456');
        $clients
            ->setEmail('client2@gmail.com')
            ->setPassword($password);

        $manager->persist($clients);

        for ($i = 0; $i < 30; ++$i) {
            $firstname = $faker->firstName();
            $lastname = $faker->lastName();
            $email = "$firstname.$lastname@gmail.com";
            $address = $faker->address();

            $user = (new Users())
                            ->setClients($clients)
                            ->setFirstname($firstname)
                            ->setLastname($lastname)
                            ->setEmail($email)
                            ->setAddress($address);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
