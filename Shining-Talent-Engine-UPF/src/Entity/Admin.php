<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 */
class Admin
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Utilisateur::class, mappedBy="admin", cascade={"persist", "remove"})
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
            $this->utilisateur->setAdmin(null);
        }

        // set the owning side of the relation if necessary
        if ($utilisateur !== null && $utilisateur->getAdmin() !== $this) {
            $utilisateur->setAdmin($this);
        }

        $this->utilisateur = $utilisateur;

        return $this;
    }
}
