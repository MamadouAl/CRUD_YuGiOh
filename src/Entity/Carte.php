<?php

namespace App\Entity;

use App\Repository\CarteEditionRepository;
use App\Repository\CarteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarteRepository::class)]
class Carte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // #[ORM\Column]
    // private ?int $num_carte = null;

    #[ORM\Column(length: 255)]
    private ?string $carte_nom = null;

    #[ORM\Column(length: 255)]
    private ?string $carte_categorie = null;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $carte_attribut = null;

    #[ORM\Column(length: 255)]
    private ?string $carte_image = null;

    #[ORM\Column(length: 255)]
    private ?string $carte_type = null;

    #[ORM\Column(nullable: true)]
    private ?int $carte_niveau = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $carte_specificite = null;

    #[ORM\Column(nullable: true)]
    private ?int $carte_ATK = null;

    #[ORM\Column(nullable: true)]
    private ?int $carte_DEF = null;

   #[ORM\Column(length: 200000, nullable: true)]
    private ?string $carte_description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    // public function getNumCarte(): ?int
    // {
    //     return $this->num_carte;
    // }

    // public function setNumCarte(int $num_carte): static
    // {
    //     $this->num_carte = $num_carte;

    //     return $this;
    // }

    public function getCarteNom(): ?string
    {
        return $this->carte_nom;
    }

    public function setCarteNom(string $carte_nom): static
    {
        $this->carte_nom = $carte_nom;

        return $this;
    }

    public function getCarteCategorie(): ?string
    {
        return $this->carte_categorie;
    }

    public function setCarteCategorie(string $carte_categorie): static
    {
        $this->carte_categorie = $carte_categorie;

        return $this;
    }

    public function getCarteAttribut(): ?string
    {
        return $this->carte_attribut;
    }

    public function setCarteAttribut(string $carte_attribut): static
    {
        $this->carte_attribut = $carte_attribut;

        return $this;
    }

    public function getCarteImage(): ?string
    {
        return $this->carte_image;
    }

    public function setCarteImage(string $carte_image): static
    {
        $this->carte_image = $carte_image;

        return $this;
    }

    public function getCarteType(): ?string
    {
        return $this->carte_type;
    }

    public function setCarteType(string $carte_type): static
    {
        $this->carte_type = $carte_type;

        return $this;
    }

    public function getCarteNiveau(): ?int
    {
        return $this->carte_niveau;
    }

    public function setCarteNiveau(?int $carte_niveau): static
    {
        $this->carte_niveau = $carte_niveau;

        return $this;
    }

    public function getCarteSpecificite(): ?string
    {
        return $this->carte_specificite;
    }

    public function setCarteSpecificite(?string $carte_specificite): static
    {
        $this->carte_specificite = $carte_specificite;

        return $this;
    }

    public function getCarteATK(): ?int
    {
        return $this->carte_ATK;
    }

    public function setCarteATK(?int $carte_ATK): static
    {
        $this->carte_ATK = $carte_ATK;

        return $this;
    }

    public function getCarteDEF(): ?int
    {
        return $this->carte_DEF;
    }

    public function setCarteDEF(?int $carte_DEF): static
    {
        $this->carte_DEF = $carte_DEF;

        return $this;
    }

    public function getCarteDescription(): ?string
    {
        return $this->carte_description;
    }

    public function setCarteDescription(?string $carte_description): static
    {
        $this->carte_description = $carte_description;

        return $this;
    }

    //methode qui permet de renvoyer l'id de l'edition de la carte
    public function getEditionId(EntityManagerInterface $em, CarteEditionRepository $carteEditionRepository): ?int
    {
        $carteEdition = $carteEditionRepository->findOneBy(['carte' => $this->getId()]);
        if ($carteEdition) {
            $edition = $carteEdition->getEdition();
            if ($edition) {
                return $edition->getId();
            }
        }
        return null;
    }
}
