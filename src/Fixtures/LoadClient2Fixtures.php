<?php

namespace App\Fixtures;

use App\Entity\Clients;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class LoadClient2Fixtures extends Fixture
{
    protected UserPasswordHasherInterface $password;

    public function __construct(UserPasswordHasherInterface $password)
    {
        $this->password = $password;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $clients = (new Clients())
            ->setEmail('client2@gmail.com');
        $clients->setPassword($this->password->hashPassword($clients, '123456'));
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
