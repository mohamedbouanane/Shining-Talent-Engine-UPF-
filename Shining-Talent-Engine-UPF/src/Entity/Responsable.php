<?php

namespace App\Entity;

use App\Repository\ResponsableRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResponsableRepository::class)
 */
class Responsable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Utilisateur::class, mappedBy="responsable", cascade={"persist", "remove"})
     */
    private $utilisateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        // unset the owning side of the relation if necessary
        if ($utilisateur === null && $this->utilisateur !== null) {
            $this->utilisateur->setResponsable(null);
        }

        // set the owning side of the relation if necessary
        if ($utilisateur !== null && $utilisateur->getResponsable() !== $this) {
            $utilisateur->setResponsable($this);
        }

        $this->utilisateur = $utilisateur;

        return $this;
    }
}
