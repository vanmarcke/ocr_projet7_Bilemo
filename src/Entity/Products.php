<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\ORM\Mapping as ORM;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema()
 *
 * @Hateoas\Relation(
 *      "self",
 *      href=@Hateoas\Route(
 *          "product_show",
 *          parameters={"id" = "expr(object.getId())" },
 *          absolute = true),
 *          exclusion = @Hateoas\Exclusion(groups={"default","show_products"})
 *      )
 *
 * @ExclusionPolicy("ALL")
 */
#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['show_products', 'product_id'])]
    #[Expose]
    #[Type('integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['show_products', 'product_id'])]
    #[Expose]
    #[Type('string')]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['product_id'])]
    #[Expose]
    #[Type('string')]
    private $brand;

    #[ORM\Column(type: 'float')]
    #[Groups(['product_id'])]
    #[Expose]
    #[Type('float')]
    private $size;

    #[ORM\Column(type: 'float')]
    #[Groups(['show_products', 'product_id'])]
    #[Expose]
    #[Type('float')]
    private $price;

    #[ORM\Column(type: 'text')]
    #[Groups(['show_products', 'product_id'])]
    #[Expose]
    #[Type('string')]
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
