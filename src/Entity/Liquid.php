<?php

namespace App\Entity;

use App\Repository\LiquidRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LiquidRepository::class)]
class Liquid
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $multiplicator = null;

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

    public function getMultiplicator(): ?int
    {
        return $this->multiplicator;
    }

    public function setMultiplicator(int $multiplicator): static
    {
        $this->multiplicator = $multiplicator;

        return $this;
    }
}
