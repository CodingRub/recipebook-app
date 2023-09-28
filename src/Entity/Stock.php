<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\StockRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockRepository::class)]
#[ApiResource]
class Stock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Aliment::class)]
    private Collection $aliments;

    #[ORM\Column]
    private ?int $quantite = null;

    public function __construct()
    {
        $this->aliments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Aliment>
     */
    public function getAliments(): Collection
    {
        return $this->aliments;
    }

    public function addAliment(Aliment $aliment): static
    {
        if (!$this->aliments->contains($aliment)) {
            $this->aliments->add($aliment);
        }

        return $this;
    }

    public function removeAliment(Aliment $aliment): static
    {
        $this->aliments->removeElement($aliment);

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }
}
