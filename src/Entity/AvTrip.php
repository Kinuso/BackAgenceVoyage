<?php

namespace App\Entity;

use App\Repository\AvTripRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvTripRepository::class)]
class AvTrip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $picture = null;

    #[ORM\Column(length: 1000)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $start = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $finish = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?AvUser $AvUser = null;

    /**
     * @var Collection<int, AvCategory>
     */
    #[ORM\ManyToMany(targetEntity: AvCategory::class)]
    private Collection $AvCategory;

    /**
     * @var Collection<int, AvCountry>
     */
    #[ORM\ManyToMany(targetEntity: AvCountry::class)]
    private Collection $AvCountry;

    /**
     * @var Collection<int, AvReservation>
     */
    #[ORM\OneToMany(targetEntity: AvReservation::class, mappedBy: 'TripId')]
    private Collection $AvReservation;

    public function __construct()
    {
        $this->AvCategory = new ArrayCollection();
        $this->AvCountry = new ArrayCollection();
        $this->AvReservation = new ArrayCollection();
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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): static
    {
        $this->picture = $picture;

        return $this;
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): static
    {
        $this->start = $start;

        return $this;
    }

    public function getFinish(): ?\DateTimeInterface
    {
        return $this->finish;
    }

    public function setFinish(\DateTimeInterface $finish): static
    {
        $this->finish = $finish;

        return $this;
    }

    public function getAvUser(): ?AvUser
    {
        return $this->AvUser;
    }

    public function setAvUser(?AvUser $AvUser): static
    {
        $this->AvUser = $AvUser;

        return $this;
    }

    /**
     * @return Collection<int, AvCategory>
     */
    public function getAvCategory(): Collection
    {
        return $this->AvCategory;
    }

    public function addAvCategory(AvCategory $avCategory): static
    {
        if (!$this->AvCategory->contains($avCategory)) {
            $this->AvCategory->add($avCategory);
        }

        return $this;
    }

    public function removeAvCategory(AvCategory $avCategory): static
    {
        $this->AvCategory->removeElement($avCategory);

        return $this;
    }

    /**
     * @return Collection<int, AvCountry>
     */
    public function getAvCountry(): Collection
    {
        return $this->AvCountry;
    }

    public function addAvCountry(AvCountry $avCountry): static
    {
        if (!$this->AvCountry->contains($avCountry)) {
            $this->AvCountry->add($avCountry);
        }

        return $this;
    }

    public function removeAvCountry(AvCountry $avCountry): static
    {
        $this->AvCountry->removeElement($avCountry);

        return $this;
    }

    /**
     * @return Collection<int, AvReservation>
     */
    public function getAvReservation(): Collection
    {
        return $this->AvReservation;
    }

    public function addAvReservation(AvReservation $avReservation): static
    {
        if (!$this->AvReservation->contains($avReservation)) {
            $this->AvReservation->add($avReservation);
            $avReservation->setTripId($this);
        }

        return $this;
    }

    public function removeAvReservation(AvReservation $avReservation): static
    {
        if ($this->AvReservation->removeElement($avReservation)) {
            // set the owning side to null (unless already changed)
            if ($avReservation->getTripId() === $this) {
                $avReservation->setTripId(null);
            }
        }

        return $this;
    }
}
