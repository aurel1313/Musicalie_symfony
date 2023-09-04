<?php

namespace App\Entity;

use App\Repository\DepartementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartementsRepository::class)]
class Departements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'departements', targetEntity: Festivals::class, orphanRemoval: true)]
    private Collection $Festival_id;

    public function __construct()
    {
        $this->Festival_id = new ArrayCollection();
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

    /**
     * @return Collection<int, Festivals>
     */
    public function getFestivalId(): Collection
    {
        return $this->Festival_id;
    }

    public function addFestivalId(Festivals $festivalId): static
    {
        if (!$this->Festival_id->contains($festivalId)) {
            $this->Festival_id->add($festivalId);
            $festivalId->setDepartements($this);
        }

        return $this;
    }

    public function removeFestivalId(Festivals $festivalId): static
    {
        if ($this->Festival_id->removeElement($festivalId)) {
            // set the owning side to null (unless already changed)
            if ($festivalId->getDepartements() === $this) {
                $festivalId->setDepartements(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
