<?php

namespace App\Entity;

use App\Repository\LangueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LangueRepository::class)]
class Langue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // #[ORM\Column]
    // private ?int $num_langue = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_langue = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    // public function getNumLangue(): ?int
    // {
    //     return $this->num_langue;
    // }

    // public function setNumLangue(int $num_langue): static
    // {
    //     $this->num_langue = $num_langue;

    //     return $this;
    // }

    public function getNomLangue(): ?string
    {
        return $this->nom_langue;
    }

    public function setNomLangue(string $nom_langue): static
    {
        $this->nom_langue = $nom_langue;

        return $this;
    }
}
