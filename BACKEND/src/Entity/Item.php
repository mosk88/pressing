<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(normalizationContext: ["groups" => ["item:read"]])]
#[ORM\Entity(repositoryClass: ItemRepository::class)]

class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['item:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['item:read'])]

    private ?int $serviceQuantity = null;

    #[ORM\Column]
    #[Groups(['item:read'])]

    private ?float $total = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    #[Groups(['item:read'])]

    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    #[Groups(['item:read'])]

    private ?Service $service = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    #[Groups(['item:read','garment:read'])]

    private ?Garment $garment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServiceQuantity(): ?int
    {
        return $this->serviceQuantity;
    }

    public function setServiceQuantity(int $serviceQuantity): static
    {
        $this->serviceQuantity = $serviceQuantity;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): static
    {
        $this->service = $service;

        return $this;
    }

    public function getGarment(): ?Garment
    {
        return $this->garment;
    }

    public function setGarment(?Garment $garment): static
    {
        $this->garment = $garment;

        return $this;
    }
}
