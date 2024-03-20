<?php

namespace App\Entity;

use App\Repository\CartePossedeeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartePossedeeRepository::class)]
class CartePossedee
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Carte::class)]
    #[ORM\JoinColumn(name : 'carte_id', referencedColumnName: 'id')]
    private ?int $carte;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Edition::class)]
    #[ORM\JoinColumn(name : 'edition_id', referencedColumnName: 'id')]
    private ?int $edition;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Langue::class)]
    #[ORM\JoinColumn(name : 'langue_id', referencedColumnName: 'id')]
    private ?int $langue = null;

    #[ORM\Column]
    private ?int $quantite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarte(): ?int
    {
        return $this->carte;
    }

    public function setCarte(int $carte): static
    {
        $this->carte = $carte;

        return $this;
    }

    public function getEdition(): ?int
    {
        return $this->edition;
    }

    public function setEdition(int $edition): static
    {
        $this->edition = $edition;

        return $this;
    }

    public function getLangue(): ?int
    {
        return $this->langue;
    }

    public function setLangue(int $langue): static
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
