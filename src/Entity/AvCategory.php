<?php

namespace App\Entity;

use App\Repository\AvCategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AvCategoryRepository::class)]
class AvCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['api_trips_show', 'api_miscallineous_show', 'api_trips_category_show'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['api_trips_show', 'api_miscallineous_show', 'api_trips_category_show'])]
    private ?string $name = null;

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
}
