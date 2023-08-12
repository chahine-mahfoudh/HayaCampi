<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivraisonRepository::class)
 */
class Livraison
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function __toString()
    {
        return(string)$this->getid();
    }

    /**
     * @ORM\OneToMany(targetEntity=Livreur::class, mappedBy="livraison")
     */
    private $nomLivreur;


    /**
     * @ORM\OneToMany(targetEntity=Livreur::class, mappedBy="livraison")
     */
    private $cin;

    /**
     * @ORM\OneToMany(targetEntity=Livreur::class, mappedBy="livraison")
     */
    private $numeroTelephone;

    /**
     * @ORM\Column(type="integer")
     */
    private $idCommande;


    public function __construct()
    {
        $this->nomLivreur = new ArrayCollection();
        $this->cin = new ArrayCollection();
        $this->numeroTelephone = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, livreur>
     */
    public function getNomLivreur(): Collection
    {
        return $this->nomLivreur;
    }

    public function addNomLivreur(livreur $nomLivreur): self
    {
        if (!$this->nomLivreur->contains($nomLivreur)) {
            $this->nomLivreur[] = $nomLivreur;
            $nomLivreur->setLivraison($this);
        }

        return $this;
    }

    public function removeNomLivreur(livreur $nomLivreur): self
    {
        if ($this->nomLivreur->removeElement($nomLivreur)) {
            // set the owning side to null (unless already changed)
            if ($nomLivreur->getLivraison() === $this) {
                $nomLivreur->setLivraison(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, livreur>
     */
    public function getCin(): Collection
    {
        return $this->cin;
    }

    public function addCin(livreur $cin): self
    {
        if (!$this->cin->contains($cin)) {
            $this->cin[] = $cin;
            $cin->setLivraison($this);
        }

        return $this;
    }

    public function removeCin(livreur $cin): self
    {
        if ($this->cin->removeElement($cin)) {
            // set the owning side to null (unless already changed)
            if ($cin->getLivraison() === $this) {
                $cin->setLivraison(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, livreur>
     */
    public function getNumeroTelephone(): Collection
    {
        return $this->numeroTelephone;
    }

    public function addNumeroTelephone(livreur $numeroTelephone): self
    {
        if (!$this->numeroTelephone->contains($numeroTelephone)) {
            $this->numeroTelephone[] = $numeroTelephone;
            $numeroTelephone->setLivraison($this);
        }

        return $this;
    }

    public function removeNumeroTelephone(livreur $numeroTelephone): self
    {
        if ($this->numeroTelephone->removeElement($numeroTelephone)) {
            // set the owning side to null (unless already changed)
            if ($numeroTelephone->getLivraison() === $this) {
                $numeroTelephone->setLivraison(null);
            }
        }

        return $this;
    }

    public function getIdCommande(): ?int
    {
        return $this->idCommande;
    }

    public function setIdCommande(int $idCommande): self
    {
        $this->idCommande = $idCommande;

        return $this;
    }
}


