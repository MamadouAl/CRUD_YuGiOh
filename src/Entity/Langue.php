<?php

namespace App\Entity;

use App\Repository\LangueRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LangueRepository::class)]
class Langue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le nom de la langue ne peut pas être vide.")]
    #[Assert\Length(
        max: 255,
        maxMessage: "Le nom de la langue ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $nom_langue = null;

    public function getId(): ?int
    {
        return $this->id;
    }

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
