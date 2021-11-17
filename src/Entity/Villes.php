<?php

namespace App\Entity;

use App\Repository\VillesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VillesRepository::class)
 */
class Villes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Conteneur::class, mappedBy="ville")
     */
    private $conteneurs;

    /**
     * @ORM\ManyToOne(targetEntity=Departement::class, inversedBy="villes")
     */
    private $departement;

    public function __construct()
    {
        $this->conteneurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Conteneur[]
     */
    public function getConteneurs(): Collection
    {
        return $this->conteneurs;
    }

    public function addConteneur(Conteneur $conteneur): self
    {
        if (!$this->conteneurs->contains($conteneur)) {
            $this->conteneurs[] = $conteneur;
            $conteneur->setVille($this);
        }

        return $this;
    }

    public function removeConteneur(Conteneur $conteneur): self
    {
        if ($this->conteneurs->removeElement($conteneur)) {
            // set the owning side to null (unless already changed)
            if ($conteneur->getVille() === $this) {
                $conteneur->setVille(null);
            }
        }

        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }
}
