<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table("Cars")]
#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Serie = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Date_Mise_En = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Modele = null;

    #[ORM\Column]
    private ?float $Prix_jour = null;



    #[ORM\OneToMany(mappedBy: 'voiture', targetEntity: Modele::class)]
    private Collection $modeles;

    #[ORM\ManyToOne(inversedBy: 'voiture')]
    private ?Modele $modele = null;

    public function __construct()
    {
        $this->Location = new ArrayCollection();
        $this->modeles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSerie(): ?string
    {
        return $this->Serie;
    }

    public function setSerie(?string $Serie): static
    {
        $this->Serie = $Serie;

        return $this;
    }

    public function getDateMiseEn(): ?\DateTimeInterface
    {
        return $this->Date_Mise_En;
    }

    public function setDateMiseEn(?\DateTimeInterface $Date_Mise_En): static
    {
        $this->Date_Mise_En = $Date_Mise_En;

        return $this;
    }



    public function getPrixJour(): ?float
    {
        return $this->Prix_jour;
    }

    public function setPrixJour(float $Prix_jour): static
    {
        $this->Prix_jour = $Prix_jour;

        return $this;
    }

    /**
     * @return Collection<int, Location>
     */
    public function getLocation(): Collection
    {
        return $this->Location;
    }

    public function addLocation(Location $location): static
    {
        if (!$this->Location->contains($location)) {
            $this->Location->add($location);
            $location->setVoiture($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): static
    {
        if ($this->Location->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getVoiture() === $this) {
                $location->setVoiture(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Modele>
     */
    public function getModeles(): Collection
    {
        return $this->modeles;
    }

    public function addModele(Modele $modele): static
    {
        if (!$this->modeles->contains($modele)) {
            $this->modeles->add($modele);
            $modele->setVoiture($this);
        }

        return $this;
    }

    public function removeModele(Modele $modele): static
    {
        if ($this->modeles->removeElement($modele)) {
            // set the owning side to null (unless already changed)
            if ($modele->getVoiture() === $this) {
                $modele->setVoiture(null);
            }
        }

        return $this;
    }

    public function getModele(): ?Modele
    {
        return $this->modele;
    }

    public function setModele(?Modele $modele): static
    {
        $this->modele = $modele;

        return $this;
    }
}
