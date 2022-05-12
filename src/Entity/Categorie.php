<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Nom;

    #[ORM\Column(type: 'integer')]
    private $Annee;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: FKArticle::class)]
    private $kleyetrangere;

    public function __construct()
    {
        $this->kleyetrangere = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->Annee;
    }

    public function setAnnee(int $Annee): self
    {
        $this->Annee = $Annee;

        return $this;
    }

    /**
     * @return Collection<int, FKArticle>
     */
    public function getKleyetrangere(): Collection
    {
        return $this->kleyetrangere;
    }

    public function addKleyetrangere(FKArticle $kleyetrangere): self
    {
        if (!$this->kleyetrangere->contains($kleyetrangere)) {
            $this->kleyetrangere[] = $kleyetrangere;
            $kleyetrangere->setCategorie($this);
        }

        return $this;
    }

    public function removeKleyetrangere(FKArticle $kleyetrangere): self
    {
        if ($this->kleyetrangere->removeElement($kleyetrangere)) {
            // set the owning side to null (unless already changed)
            if ($kleyetrangere->getCategorie() === $this) {
                $kleyetrangere->setCategorie(null);
            }
        }

        return $this;
    }
}
