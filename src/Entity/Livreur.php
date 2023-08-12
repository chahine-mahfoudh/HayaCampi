<?php

namespace App\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Livraison;
use App\Repository\LivreurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivreurRepository::class)
 * @UniqueEntity("cin")
 * @UniqueEntity("numeroTelephone")
 */
class Livreur
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
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nomLivreur;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $prenomLivreur;

    /**
     * @ORM\Column(type="bigint")
     *   @Assert\Length(
     *   min = 8,
     *   max = 8,
     *   Message = "Your CIN should be 8 numbers")
     * @Assert\NotBlank(message="Numero CIN is required")
     */
    private $cin;

    /**
     * @ORM\Column(type="bigint")
     * @Assert\Length(
     *   min = 8,
     *   max = 8,
     *   maxMessage = "Your Phone number should be 8 numbers")
     * @Assert\NotBlank(message="Numero Telephone is required")
     */
    private $numeroTelephone;

    /**
     * @ORM\ManyToOne(targetEntity=Livraison::class, inversedBy="nomLivreur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $livraison;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomLivreur(): ?string
    {
        return $this->nomLivreur;
    }

    public function setNomLivreur(string $nomLivreur): self
    {
        $this->nomLivreur = $nomLivreur;

        return $this;
    }

    public function getPrenomLivreur(): ?string
    {
        return $this->prenomLivreur;
    }

    public function setPrenomLivreur(string $prenomLivreur): self
    {
        $this->prenomLivreur = $prenomLivreur;

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getNumeroTelephone(): ?string
    {
        return $this->numeroTelephone;
    }

    public function setNumeroTelephone(string $numeroTelephone): self
    {
        $this->numeroTelephone = $numeroTelephone;

        return $this;
    }

    public function getLivraison(): ?Livraison
    {
        return $this->livraison;
    }

    public function setLivraison(?Livraison $livraison): self
    {
        $this->livraison = $livraison;

        return $this;
    }
}
