<?php

namespace App\Entity;

use App\Repository\SizeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SizeRepository::class)]
class Size
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $volume = null;

    #[ORM\Column]
    private ?int $multiplicator = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(int $volume): static
    {
        $this->volume = $volume;

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
