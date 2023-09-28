<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AlimentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlimentRepository::class)]
#[ApiResource]
class Aliment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'aliments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeAliment $type = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $unite = null;

    #[ORM\ManyToOne(inversedBy: 'aliments')]
    private ?ListeCourse $listeCourse = null;

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

    public function getType(): ?TypeAliment
    {
        return $this->type;
    }

    public function setType(?TypeAliment $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getUnite(): ?string
    {
        return $this->unite;
    }

    public function setUnite(?string $unite): static
    {
        $this->unite = $unite;

        return $this;
    }

    public function getListeCourse(): ?ListeCourse
    {
        return $this->listeCourse;
    }

    public function setListeCourse(?ListeCourse $listeCourse): static
    {
        $this->listeCourse = $listeCourse;

        return $this;
    }
}
