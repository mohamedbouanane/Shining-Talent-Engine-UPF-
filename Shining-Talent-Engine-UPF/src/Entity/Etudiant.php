<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtudiantRepository::class)
 */
class Etudiant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $publicProfileState;

    /**
     * @ORM\OneToOne(targetEntity=Utilisateur::class, mappedBy="etudiant", cascade={"persist", "remove"})
     */
    private $utilisateur;

    /**
     * @ORM\OneToMany(targetEntity=cv::class, mappedBy="etudiant")
     */
    private $lsCvs;

    /**
     * @ORM\OneToOne(targetEntity=cv::class, inversedBy="etudiantActif", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $activeCV;

    public function __construct()
    {
        $this->lsCvs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPublicProfileState(): ?bool
    {
        return $this->publicProfileState;
    }

    public function setPublicProfileState(bool $publicProfileState): self
    {
        $this->publicProfileState = $publicProfileState;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        // unset the owning side of the relation if necessary
        if ($utilisateur === null && $this->utilisateur !== null) {
            $this->utilisateur->setEtudiant(null);
        }

        // set the owning side of the relation if necessary
        if ($utilisateur !== null && $utilisateur->getEtudiant() !== $this) {
            $utilisateur->setEtudiant($this);
        }

        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * @return Collection|cv[]
     */
    public function getLsCvs(): Collection
    {
        return $this->lsCvs;
    }

    public function addLsCv(cv $lsCv): self
    {
        if (!$this->lsCvs->contains($lsCv)) {
            $this->lsCvs[] = $lsCv;
            $lsCv->setEtudiant($this);
        }

        return $this;
    }

    public function removeLsCv(cv $lsCv): self
    {
        if ($this->lsCvs->removeElement($lsCv)) {
            // set the owning side to null (unless already changed)
            if ($lsCv->getEtudiant() === $this) {
                $lsCv->setEtudiant(null);
            }
        }

        return $this;
    }

    public function getActiveCV(): ?cv
    {
        return $this->activeCV;
    }

    public function setActiveCV(cv $activeCV): self
    {
        $this->activeCV = $activeCV;

        return $this;
    }
}
