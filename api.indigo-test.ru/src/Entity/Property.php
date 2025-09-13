<?php
// src/Entity/Property.php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PropertyRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => ['property:read']]),
        new GetCollection(
            normalizationContext: ['groups' => ['property:read']],
            paginationItemsPerPage: 12
        )
    ]
)]
class Property
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['property:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['property:read'])]
    #[Assert\NotBlank]
    #[Assert\Length(min: 5, max: 255)]
    private ?string $title = null;

    #[ORM\Column(type: 'text')]
    #[Groups(['property:read'])]
    #[Assert\NotBlank]
    private ?string $description = null;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2)]
    #[Groups(['property:read'])]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private ?string $price = null;

    #[ORM\Column(length: 3)]
    #[Groups(['property:read'])]
    private ?string $currency = 'RUB';

    #[ORM\Column(type: 'float')]
    #[Groups(['property:read'])]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private ?float $area = null;

    #[ORM\Column(length: 10)]
    #[Groups(['property:read'])]
    private ?string $areaUnit = 'м²';

    #[ORM\Column(length: 255)]
    #[Groups(['property:read'])]
    #[Assert\NotBlank]
    private ?string $address = null;

    #[ORM\Column(length: 100)]
    #[Groups(['property:read'])]
    #[Assert\NotBlank]
    private ?string $city = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['property:read'])]
    private ?string $district = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['property:read'])]
    #[Assert\NotBlank]
    private ?string $type = null; // apartment, house, commercial, land

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['property:read'])]
    #[Assert\NotBlank]
    private ?string $category = null; // rent, sale

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['property:read'])]
    private ?int $rooms = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['property:read'])]
    private ?int $floor = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['property:read'])]
    private ?int $totalFloors = null;

    #[ORM\Column(type: 'json')]
    #[Groups(['property:read'])]
    private array $amenities = [];

    #[ORM\Column(type: 'boolean')]
    #[Groups(['property:read'])]
    private bool $isActive = true;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Groups(['property:read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Groups(['property:read'])]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(type: 'simple_array', nullable: true)]
    #[Groups(['property:read'])]
    private array $images = [];

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    // Геттеры и сеттеры
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    public function getArea(): ?float
    {
        return $this->area;
    }

    public function setArea(float $area): self
    {
        $this->area = $area;
        return $this;
    }

    public function getAreaUnit(): ?string
    {
        return $this->areaUnit;
    }

    public function setAreaUnit(string $areaUnit): self
    {
        $this->areaUnit = $areaUnit;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function setDistrict(?string $district): self
    {
        $this->district = $district;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    public function setRooms(?int $rooms): self
    {
        $this->rooms = $rooms;
        return $this;
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(?int $floor): self
    {
        $this->floor = $floor;
        return $this;
    }

    public function getTotalFloors(): ?int
    {
        return $this->totalFloors;
    }

    public function setTotalFloors(?int $totalFloors): self
    {
        $this->totalFloors = $totalFloors;
        return $this;
    }

    public function getAmenities(): array
    {
        return $this->amenities;
    }

    public function setAmenities(array $amenities): self
    {
        $this->amenities = $amenities;
        return $this;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getImages(): array
    {
        return $this->images;
    }

    public function setImages(array $images): self
    {
        $this->images = $images;
        return $this;
    }

    #[ORM\PreUpdate]
    public function updateTimestamps(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }
}