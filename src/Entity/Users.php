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
use Symfony\Component\Validator\Constraints as Assert;

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
 * @Hateoas\Relation(
 *      "create",
 *      href=@Hateoas\Route(
 *          "user_add",
 *          absolute = true),
 *          exclusion = @Hateoas\Exclusion(groups={"default","show_users"})
 *      )
 *
 * @Hateoas\Relation(
 *      "update",
 *      href=@Hateoas\Route(
 *          "user_patch",
 *          parameters={"id" = "expr(object.getId())" },
 *          absolute = true),
 *          exclusion = @Hateoas\Exclusion(groups={"default","show_users"})
 *      )
 *
 * @Hateoas\Relation(
 *      "delete",
 *      href=@Hateoas\Route(
 *          "user_delete",
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
    #[Groups(['show_users', 'user', 'user_id'])]
    #[Expose]
    #[Type('integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['show_users', 'user_add'])]
    #[Expose]
    #[Type('string')]
    #[Assert\NotBlank]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['show_users', 'user_add'])]
    #[Expose]
    #[Type('string')]
    #[Assert\NotBlank]
    private $lastname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['user', 'user_add', 'user_id'])]
    #[Expose]
    #[Type('string')]
    #[Assert\Email]
    #[Assert\NotBlank]
    private $email;

    #[ORM\Column(type: 'text')]
    #[Groups(['user', 'user_add', 'user_id'])]
    #[Expose]
    #[Type('string')]
    #[Assert\NotBlank]
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
