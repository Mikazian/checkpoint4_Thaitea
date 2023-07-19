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

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_new = null;

    #[ORM\Column(nullable: true)]
    private ?int $sold = null;

    #[ORM\OneToMany(mappedBy: 'beverage', targetEntity: liquid::class)]
    private Collection $liquid_id;

    #[ORM\OneToMany(mappedBy: 'beverage', targetEntity: aroma::class)]
    private Collection $aroma_id;

    #[ORM\OneToMany(mappedBy: 'beverage', targetEntity: bubble::class)]
    private Collection $bubble_id;

    #[ORM\ManyToOne(inversedBy: 'beverages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $creator_id = null;

    #[ORM\ManyToOne(inversedBy: 'beverage_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?OrderItem $orderItem = null;

    public function __construct()
    {
        $this->liquid_id = new ArrayCollection();
        $this->aroma_id = new ArrayCollection();
        $this->bubble_id = new ArrayCollection();
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

    /**
     * @return Collection<int, liquid>
     */
    public function getLiquidId(): Collection
    {
        return $this->liquid_id;
    }

    public function addLiquidId(liquid $liquidId): static
    {
        if (!$this->liquid_id->contains($liquidId)) {
            $this->liquid_id->add($liquidId);
            $liquidId->setBeverage($this);
        }

        return $this;
    }

    public function removeLiquidId(liquid $liquidId): static
    {
        if ($this->liquid_id->removeElement($liquidId)) {
            // set the owning side to null (unless already changed)
            if ($liquidId->getBeverage() === $this) {
                $liquidId->setBeverage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, aroma>
     */
    public function getAromaId(): Collection
    {
        return $this->aroma_id;
    }

    public function addAromaId(aroma $aromaId): static
    {
        if (!$this->aroma_id->contains($aromaId)) {
            $this->aroma_id->add($aromaId);
            $aromaId->setBeverage($this);
        }

        return $this;
    }

    public function removeAromaId(aroma $aromaId): static
    {
        if ($this->aroma_id->removeElement($aromaId)) {
            // set the owning side to null (unless already changed)
            if ($aromaId->getBeverage() === $this) {
                $aromaId->setBeverage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, bubble>
     */
    public function getBubbleId(): Collection
    {
        return $this->bubble_id;
    }

    public function addBubbleId(bubble $bubbleId): static
    {
        if (!$this->bubble_id->contains($bubbleId)) {
            $this->bubble_id->add($bubbleId);
            $bubbleId->setBeverage($this);
        }

        return $this;
    }

    public function removeBubbleId(bubble $bubbleId): static
    {
        if ($this->bubble_id->removeElement($bubbleId)) {
            // set the owning side to null (unless already changed)
            if ($bubbleId->getBeverage() === $this) {
                $bubbleId->setBeverage(null);
            }
        }

        return $this;
    }

    public function getCreatorId(): ?user
    {
        return $this->creator_id;
    }

    public function setCreatorId(?user $creator_id): static
    {
        $this->creator_id = $creator_id;

        return $this;
    }

    public function getOrderItem(): ?OrderItem
    {
        return $this->orderItem;
    }

    public function setOrderItem(?OrderItem $orderItem): static
    {
        $this->orderItem = $orderItem;

        return $this;
    }
}
