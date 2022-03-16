<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;

/**
 * @Hateoas\Relation(
 *      "self",
 *      href=@Hateoas\Route(
 *          "product_show",
 *          parameters={"id" = "expr(object.getId())" },
 *          absolute = true
 *      )
 * )
 */
#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Serializer\Groups(["show_products", "product"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Serializer\Groups(["show_products", "product"])]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    #[Serializer\Groups(["product"])]
    private $brand;

    #[ORM\Column(type: 'float')]
    #[Serializer\Groups(["product"])]
    private $size;

    #[ORM\Column(type: 'float')]
    #[Serializer\Groups(["show_products", "product"])]
    private $price;

    #[ORM\Column(type: 'text')]
    #[Serializer\Groups(["show_products", "product"])]
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getSize(): ?float
    {
        return $this->size;
    }

    public function setSize(float $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
