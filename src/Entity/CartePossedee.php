<?php

namespace App\Entity;

use App\Repository\CartePossedeeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartePossedeeRepository::class)]
#[ORM\Table(name: "carte_possedee")]
class CartePossedee
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Carte::class)]
    #[ORM\JoinColumn(name: 'carte_id', referencedColumnName: 'id')]
    private ?Carte $carte;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Edition::class)]
    #[ORM\JoinColumn(name : 'edition_id', referencedColumnName: 'id')]
    private ?Edition $edition;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Langue::class)]
    #[ORM\JoinColumn(name : 'langue_id', referencedColumnName: 'id')]
    private ?Langue $langue = null;

    #[ORM\Column]
    private ?int $quantite = null;

   
    public function getCarte(): ?Carte
    {
        return $this->carte;
    }

    public function setCarte(Carte $carte): static
    {
        $this->carte = $carte;

        return $this;
    }

    public function getEdition(): ?Edition
    {
        return $this->edition;
    }

    public function setEdition(Edition $edition): static
    {
        $this->edition = $edition;

        return $this;
    }

    public function getLangue(): ?Langue
    {
        return $this->langue;
    }

    public function setLangue(Langue $langue): static
    {
        $this->langue = $langue;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;
        return $this;
    }
}
