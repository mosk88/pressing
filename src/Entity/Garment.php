<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\GarmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(normalizationContext: ["groups" => ["garment:read"]])]
#[ORM\Entity(repositoryClass: GarmentRepository::class)]


class Garment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['garment:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['garment:read'])]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Groups(['garment:read'])]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    #[Groups(['garment:read'])]
    private ?string $material = null;

    

    /**
     * @var Collection<int, Service>
     */
    #[ORM\ManyToMany(targetEntity: Service::class, inversedBy: 'garments')]
    #[Groups(['service:read'])]
    private Collection $services;

    /**
     * @var Collection<int, Item>
     */
    #[ORM\OneToMany(targetEntity: Item::class, mappedBy: 'garment')]
       private Collection $items;

    public function __construct()
    {
        $this->services = new ArrayCollection();
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getMaterial(): ?string
    {
        return $this->material;
    }

    public function setMaterial(string $material): static
    {
        $this->material = $material;

        return $this;
    }


    /**
     * @return Collection<int, Service>
     */
    public function getService(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): static
    {
        if (!$this->services->contains($service)) {
            $this->services->add($service);
        }

        return $this;
    }

    public function removeService(Service $service): static
    {
        $this->services->removeElement($service);

        return $this;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): static
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->setGarment($this);
        }

        return $this;
    }

    public function removeItem(Item $item): static
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getGarment() === $this) {
                $item->setGarment(null);
            }
        }

        return $this;
    }
}
