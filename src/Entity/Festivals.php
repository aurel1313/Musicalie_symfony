<?php

namespace App\Entity;

use App\Repository\FestivalsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FestivalsRepository::class)]
class Festivals
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $affiche = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    #[ORM\ManyToMany(targetEntity: Artistes::class, mappedBy: 'Festivals_id')]
    private Collection $artistes;

    #[ORM\ManyToOne(inversedBy: 'Festival_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Departements $departements = null;

    public function __construct()
    {
        $this->artistes = new ArrayCollection();
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): static
    {
        $this->Date = $Date;

        return $this;
    }

    public function getAffiche(): ?string
    {
        return $this->affiche;
    }

    public function setAffiche(string $affiche): static
    {
        $this->affiche = $affiche;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * @return Collection<int, Artistes>
     */
    public function getArtistes(): Collection
    {
        return $this->artistes;
    }

    public function addArtiste(Artistes $artiste): static
    {
        if (!$this->artistes->contains($artiste)) {
            $this->artistes->add($artiste);
            $artiste->addFestivalsId($this);
        }

        return $this;
    }

    public function removeArtiste(Artistes $artiste): static
    {
        if ($this->artistes->removeElement($artiste)) {
            $artiste->removeFestivalsId($this);
        }

        return $this;
    }

    public function getDepartements(): ?Departements
    {
        return $this->departements;
    }

    public function setDepartements(?Departements $departements): static
    {
        $this->departements = $departements;

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
