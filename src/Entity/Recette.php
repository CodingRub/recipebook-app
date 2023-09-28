<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecetteRepository::class)]
#[ApiResource]
class Recette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'recettes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeRecette $type = null;

    #[ORM\OneToMany(mappedBy: 'recette', targetEntity: Ingredient::class)]
    private Collection $ingredients;

    #[ORM\Column]
    private ?float $rate = null;

    #[ORM\Column(length: 15)]
    private ?string $difficulte = null;

    #[ORM\OneToMany(mappedBy: 'recette', targetEntity: Preparation::class)]
    private Collection $preparation;

    #[ORM\Column(length: 8)]
    private ?string $preparationTime = null;

    #[ORM\Column(length: 8)]
    private ?string $cookingTime = null;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'recettes')]
    private Collection $tags;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageName = null;

    #[ORM\OneToMany(mappedBy: 'recette', targetEntity: Note::class)]
    private Collection $notes;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->preparation = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->notes = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?TypeRecette
    {
        return $this->type;
    }

    public function setType(?TypeRecette $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Ingredient>
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): static
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients->add($ingredient);
            $ingredient->setRecette($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): static
    {
        if ($this->ingredients->removeElement($ingredient)) {
            // set the owning side to null (unless already changed)
            if ($ingredient->getRecette() === $this) {
                $ingredient->setRecette(null);
            }
        }

        return $this;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(float $rate): static
    {
        $this->rate = $rate;

        return $this;
    }

    public function getDifficulte(): ?string
    {
        return $this->difficulte;
    }

    public function setDifficulte(string $difficulte): static
    {
        $this->difficulte = $difficulte;

        return $this;
    }

    /**
     * @return Collection<int, Preparation>
     */
    public function getPreparation(): Collection
    {
        return $this->preparation;
    }

    public function addPreparation(Preparation $preparation): static
    {
        if (!$this->preparation->contains($preparation)) {
            $this->preparation->add($preparation);
            $preparation->setRecette($this);
        }

        return $this;
    }

    public function removePreparation(Preparation $preparation): static
    {
        if ($this->preparation->removeElement($preparation)) {
            // set the owning side to null (unless already changed)
            if ($preparation->getRecette() === $this) {
                $preparation->setRecette(null);
            }
        }

        return $this;
    }

    public function getPreparationTime(): ?string
    {
        return $this->preparationTime;
    }

    public function setPreparationTime(string $preparationTime): static
    {
        $this->preparationTime = $preparationTime;

        return $this;
    }

    public function getCookingTime(): ?string
    {
        return $this->cookingTime;
    }

    public function setCookingTime(string $cookingTime): static
    {
        $this->cookingTime = $cookingTime;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): static
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return Collection<int, Note>
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): static
    {
        if (!$this->notes->contains($note)) {
            $this->notes->add($note);
            $note->setRecette($this);
        }

        return $this;
    }

    public function removeNote(Note $note): static
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getRecette() === $this) {
                $note->setRecette(null);
            }
        }

        return $this;
    }
}
