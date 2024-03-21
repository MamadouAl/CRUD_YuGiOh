<?php

namespace App\Entity;

use App\Repository\EditionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EditionRepository::class)]
class Edition
{
   
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(length: 255)]
    
    private ?string $nom_edition = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_edition = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNomEdition(): ?string
    {
        return $this->nom_edition;
    }

    public function setNomEdition(string $nom_edition): static
    {
        $this->nom_edition = $nom_edition;

        return $this;
    }

    public function getDateEdition(): ?\DateTimeInterface
    {
        return $this->date_edition;
    }

    public function setDateEdition(\DateTimeInterface $date_edition): static
    {
        $this->date_edition = $date_edition;

        return $this;
    }
    #[ORM\OneToMany(mappedBy: 'edition', targetEntity: CarteEdition::class)]
    private Collection $carteEditions;
    private Collection $cartePossedee;

    public function __construct()
    {
        $this->carteEditions = new ArrayCollection();
        $this->cartePossedee = new ArrayCollection();
    }

    /**
     * @return Collection|CarteEdition[]
     */
    public function getCarteEditions(): Collection
    {
        return $this->carteEditions;
    }

    public function getCartePossedee(): Collection
    {
        return $this->cartePossedee;
    }
}
