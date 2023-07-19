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

    #[ORM\OneToMany(mappedBy: 'orderItem', targetEntity: beverage::class)]
    private Collection $beverage_id;

    #[ORM\OneToMany(mappedBy: 'orderItem', targetEntity: size::class)]
    private Collection $size_id;

    #[ORM\ManyToOne(inversedBy: 'orderItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?order $order_id = null;

    public function __construct()
    {
        $this->beverage_id = new ArrayCollection();
        $this->size_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, beverage>
     */
    public function getBeverageId(): Collection
    {
        return $this->beverage_id;
    }

    public function addBeverageId(beverage $beverageId): static
    {
        if (!$this->beverage_id->contains($beverageId)) {
            $this->beverage_id->add($beverageId);
            $beverageId->setOrderItem($this);
        }

        return $this;
    }

    public function removeBeverageId(beverage $beverageId): static
    {
        if ($this->beverage_id->removeElement($beverageId)) {
            // set the owning side to null (unless already changed)
            if ($beverageId->getOrderItem() === $this) {
                $beverageId->setOrderItem(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, size>
     */
    public function getSizeId(): Collection
    {
        return $this->size_id;
    }

    public function addSizeId(size $sizeId): static
    {
        if (!$this->size_id->contains($sizeId)) {
            $this->size_id->add($sizeId);
            $sizeId->setOrderItem($this);
        }

        return $this;
    }

    public function removeSizeId(size $sizeId): static
    {
        if ($this->size_id->removeElement($sizeId)) {
            // set the owning side to null (unless already changed)
            if ($sizeId->getOrderItem() === $this) {
                $sizeId->setOrderItem(null);
            }
        }

        return $this;
    }

    public function getOrderId(): ?order
    {
        return $this->order_id;
    }

    public function setOrderId(?order $order_id): static
    {
        $this->order_id = $order_id;

        return $this;
    }
}
