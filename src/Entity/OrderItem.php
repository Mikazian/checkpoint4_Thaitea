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
}
