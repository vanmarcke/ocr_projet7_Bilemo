<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use OpenApi\Annotations as OA;
use JMS\Serializer\Annotation\Type;

/**
 * @OA\Schema()
 *
 * @Hateoas\Relation(
 *      "self",
 *      href=@Hateoas\Route(
 *          "user_show",
 *          parameters={"id" = "expr(object.getId())" },
 *          absolute = true),
 *          exclusion = @Hateoas\Exclusion(groups={"default","show_users"})
 *      )
 *
 * @ExclusionPolicy("ALL")
 */
#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['show_users', 'user'])]
    #[Expose]
    #[Type('integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['show_users', 'user'])]
    #[Expose]
    #[Type('string')]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['show_users', 'user'])]
    #[Expose]
    #[Type('string')]
    private $lastname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['user'])]
    #[Expose]
    #[Type('string')]
    private $email;

    #[ORM\Column(type: 'text')]
    #[Groups(['user'])]
    #[Expose]
    #[Type('string')]
    private $address;

    #[ORM\ManyToOne(targetEntity: Clients::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $clients;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getClients(): ?Clients
    {
        return $this->clients;
    }

    public function setClients(?Clients $clients): self
    {
        $this->clients = $clients;

        return $this;
    }
}
