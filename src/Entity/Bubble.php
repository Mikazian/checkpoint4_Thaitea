<?php

namespace App\Entity;

use App\Repository\BubbleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BubbleRepository::class)]
class Bubble
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $multiplicator = null;

    #[ORM\ManyToOne(inversedBy: 'bubble_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Beverage $beverage = null;

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

    public function getBeverage(): ?Beverage
    {
        return $this->beverage;
    }

    public function setBeverage(?Beverage $beverage): static
    {
        $this->beverage = $beverage;

        return $this;
    }
}
