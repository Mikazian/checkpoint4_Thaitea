<?php

namespace App\Entity;

use App\Repository\OrderItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderItemRepository::class)]
class OrderItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orderItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?order $order = null;

    #[ORM\ManyToOne(inversedBy: 'orderItems')]
    private ?beverage $beverage = null;

    #[ORM\ManyToOne(inversedBy: 'orderItems')]
    private ?size $size = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderId(): ?order
    {
        return $this->order;
    }

    public function setOrderId(?Order $order): static
    {
        $this->order = $order;

        return $this;
    }

    public function getBeverage(): ?beverage
    {
        return $this->beverage;
    }

    public function setBeverage(?beverage $beverage): static
    {
        $this->beverage = $beverage;

        return $this;
    }

    public function getSize(): ?size
    {
        return $this->size;
    }

    public function setSize(?size $size): static
    {
        $this->size = $size;

        return $this;
    }
}
