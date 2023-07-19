<?php

namespace App\Entity;

use App\Repository\BeverageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(type: 'decimal', precision: 4, scale: 2)]
    private ?float $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_new = null;

    #[ORM\ManyToOne(inversedBy: 'beverages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $creator = null;

    #[ORM\ManyToOne(inversedBy: 'beverages')]
    private ?liquid $liquid = null;

    #[ORM\ManyToOne(inversedBy: 'beverages')]
    private ?aroma $aroma = null;

    #[ORM\ManyToOne(inversedBy: 'beverages')]
    private ?bubble $bubble = null;

    #[ORM\ManyToMany(targetEntity: ingredient::class, inversedBy: 'beverages')]
    private Collection $ingredient;

    #[ORM\OneToMany(mappedBy: 'beverage', targetEntity: OrderItem::class)]
    private Collection $orderItems;

    public function __construct()
    {
        $this->ingredient = new ArrayCollection();
        $this->orderItems = new ArrayCollection();
    }

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
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

    public function getCreatorId(): ?user
    {
        return $this->creator;
    }

    public function setCreatorId(?user $creator): static
    {
        $this->creator = $creator;

        return $this;
    }

    public function getLiquid(): ?liquid
    {
        return $this->liquid;
    }

    public function setLiquid(?liquid $liquid): static
    {
        $this->liquid = $liquid;

        return $this;
    }

    public function getAroma(): ?aroma
    {
        return $this->aroma;
    }

    public function setAroma(?aroma $aroma): static
    {
        $this->aroma = $aroma;

        return $this;
    }

    public function getBubble(): ?bubble
    {
        return $this->bubble;
    }

    public function setBubble(?bubble $bubble): static
    {
        $this->bubble = $bubble;

        return $this;
    }

    /**
     * @return Collection<int, ingredient>
     */
    public function getIngredient(): Collection
    {
        return $this->ingredient;
    }

    public function addIngredient(ingredient $ingredient): static
    {
        if (!$this->ingredient->contains($ingredient)) {
            $this->ingredient->add($ingredient);
        }

        return $this;
    }

    public function removeIngredient(ingredient $ingredient): static
    {
        $this->ingredient->removeElement($ingredient);

        return $this;
    }

    /**
     * @return Collection<int, OrderItem>
     */
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function addOrderItem(OrderItem $orderItem): static
    {
        if (!$this->orderItems->contains($orderItem)) {
            $this->orderItems->add($orderItem);
            $orderItem->setBeverage($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): static
    {
        if ($this->orderItems->removeElement($orderItem)) {
            // set the owning side to null (unless already changed)
            if ($orderItem->getBeverage() === $this) {
                $orderItem->setBeverage(null);
            }
        }

        return $this;
    }
}
