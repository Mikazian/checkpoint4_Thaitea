<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BeverageRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BeverageRepository::class)]
#[Vich\Uploadable]
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

    #[Vich\UploadableField(mapping: 'poster_file', fileNameProperty: 'image')]
    #[Assert\File(
        maxSize: '2M',
        mimeTypes: ['image/jpeg', 'image/png', 'image/webp'],
    )]
    private ?File $imageFile = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DatetimeInterface $updatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_new = false;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'beverages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $creator = null;

    #[ORM\ManyToOne(inversedBy: 'beverages')]
    private ?Liquid $liquid = null;

    #[ORM\ManyToOne(inversedBy: 'beverages')]
    private ?Aroma $aroma = null;

    #[ORM\ManyToOne(inversedBy: 'beverages')]
    private ?Bubble $bubble = null;

    #[ORM\ManyToMany(targetEntity: Ingredient::class, inversedBy: 'beverages')]
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

    /**
     * Get the value of updatedAt
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt
     *
     * @return  self
     */
    public function setUpdatedAt(DateTime $updatedAt): Beverage
    {
        $this->updatedAt = $updatedAt;

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

    public function getCreator(): ?user
    {
        return $this->creator;
    }

    public function setCreator(?user $creator): static
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

    /**
     * Get the value of imageFile
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Set the value of imageFile
     *
     * @return  self
     */
    public function setImageFile(File $image)
    {
        $this->imageFile = $image;
        if ($image) {
            $this->updatedAt = new DateTime('now');
        }

        return $this;
    }
}
