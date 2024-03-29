<?php

namespace App\Entity;

use App\Repository\CarteEditionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarteEditionRepository::class)]
#[ORM\Table(name: "carte_edition")]
class CarteEdition
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Carte::class)]
    #[ORM\JoinColumn(name: "carte_id", referencedColumnName: "id")]
    private ?Carte $carte;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Edition::class)]
    #[ORM\JoinColumn(name: "edition_id", referencedColumnName: "id")]
    private ?Edition $edition;

    #[ORM\Column(length: 255, nullable: true)]
    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="rarete", type="string", length=255)
     */
    private ?string $rarete;

    public function getCarte(): ?Carte
    {
        return $this->carte;
    }

    public function setCarte(?Carte $carte): self
    {
        $this->carte = $carte;
        return $this;
    }

    public function getEdition(): ?Edition
    {
        return $this->edition;
    }

    public function setEdition(?Edition $edition): self
    {
        $this->edition = $edition;
        return $this;
    }

    public function getRarete(): ?string
    {
        return $this->rarete;
    }

    public function setRarete(?string $rarete): self
    {
        $this->rarete = $rarete;
        return $this;
    }

}
