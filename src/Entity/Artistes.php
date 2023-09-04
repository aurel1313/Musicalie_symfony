<?php

namespace App\Entity;

use App\Repository\ArtistesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtistesRepository::class)]
class Artistes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $style_musical = null;

    #[ORM\ManyToMany(targetEntity: Festivals::class, inversedBy: 'artistes')]
    private Collection $Festivals_id;

    public function __construct()
    {
        $this->Festivals_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getStyleMusical(): ?string
    {
        return $this->style_musical;
    }

    public function setStyleMusical(string $style_musical): static
    {
        $this->style_musical = $style_musical;

        return $this;
    }

    /**
     * @return Collection<int, Festivals>
     */
    public function getFestivalsId(): Collection
    {
        return $this->Festivals_id;
    }

    public function addFestivalsId(Festivals $festivalsId): static
    {
        if (!$this->Festivals_id->contains($festivalsId)) {
            $this->Festivals_id->add($festivalsId);
        }

        return $this;
    }

    public function removeFestivalsId(Festivals $festivalsId): static
    {
        $this->Festivals_id->removeElement($festivalsId);

        return $this;
    }

    public function __toString()
    {
        // Retournez la propriété que vous souhaitez utiliser comme libellé dans le formulaire
        return $this->nom;
    }
}
