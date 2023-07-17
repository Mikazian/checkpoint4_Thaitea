<?php

namespace App\Entity;

use App\Repository\BeverageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BeverageRepository::class)]
class Beverage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_new = null;

    #[ORM\Column(nullable: true)]
    private ?int $sold = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function isIsNew(): ?bool
    {
        return $this->is_new;
    }

    public function setIsNew(?bool $is_new): static
    {
        $this->is_new = $is_new;

        return $this;
    }

    public function getSold(): ?int
    {
        return $this->sold;
    }

    public function setSold(?int $sold): static
    {
        $this->sold = $sold;

        return $this;
    }
}
