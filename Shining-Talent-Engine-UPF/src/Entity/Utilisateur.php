<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */
class Utilisateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomComplet;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToOne(targetEntity=responsable::class, inversedBy="utilisateur", cascade={"persist", "remove"})
     */
    private $responsable;

    /**
     * @ORM\OneToOne(targetEntity=admin::class, inversedBy="utilisateur", cascade={"persist", "remove"})
     */
    private $admin;

    /**
     * @ORM\OneToOne(targetEntity=etudiant::class, inversedBy="utilisateur", cascade={"persist", "remove"})
     */
    private $etudiant;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $Role): self
    {
        $this->role = $Role;

        return $this;
    }
    public function getNomComplet(): ?string
    {
        return $this->nomComplet;
    }

    public function setNomComplet(string $nomComplet): self
    {
        $this->nomComplet = $nomComplet;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getResponsable(): ?responsable
    {
        return $this->responsable;
    }

    public function setResponsable(?responsable $responsable): self
    {
        $this->responsable = $responsable;

        return $this;
    }

    public function getAdmin(): ?admin
    {
        return $this->admin;
    }

    public function setAdmin(?admin $admin): self
    {
        $this->admin = $admin;

        return $this;
    }

    public function getEtudiant(): ?etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }
}
