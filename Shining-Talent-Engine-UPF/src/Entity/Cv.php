<?php

namespace App\Entity;

use App\Repository\CvRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CvRepository::class)
 */
class Cv
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity=ExperiencePro::class, mappedBy="cv")
     */
    private $lsExperiencePro;

    /**
     * @ORM\OneToMany(targetEntity=Formation::class, mappedBy="cv")
     */
    private $lsFormations;

    /**
     * @ORM\OneToMany(targetEntity=Competence::class, mappedBy="cv")
     */
    private $lsCompetences;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="lsCv")
     */
    private $user;

    public function __construct()
    {
        $this->lsExperiencePro = new ArrayCollection();
        $this->lsFormations = new ArrayCollection();
        $this->lsCompetences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|ExperiencePro[]
     */
    public function getLsExperiencePro(): Collection
    {
        return $this->lsExperiencePro;
    }

    public function addLsExperiencePro(ExperiencePro $lsExperiencePro): self
    {
        if (!$this->lsExperiencePro->contains($lsExperiencePro)) {
            $this->lsExperiencePro[] = $lsExperiencePro;
            $lsExperiencePro->setCv($this);
        }

        return $this;
    }

    public function removeLsExperiencePro(ExperiencePro $lsExperiencePro): self
    {
        if ($this->lsExperiencePro->removeElement($lsExperiencePro)) {
            // set the owning side to null (unless already changed)
            if ($lsExperiencePro->getCv() === $this) {
                $lsExperiencePro->setCv(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getLsFormations(): Collection
    {
        return $this->lsFormations;
    }

    public function addLsFormation(Formation $lsFormation): self
    {
        if (!$this->lsFormations->contains($lsFormation)) {
            $this->lsFormations[] = $lsFormation;
            $lsFormation->setCv($this);
        }

        return $this;
    }

    public function removeLsFormation(Formation $lsFormation): self
    {
        if ($this->lsFormations->removeElement($lsFormation)) {
            // set the owning side to null (unless already changed)
            if ($lsFormation->getCv() === $this) {
                $lsFormation->setCv(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Competence[]
     */
    public function getLsCompetences(): Collection
    {
        return $this->lsCompetences;
    }

    public function addLsCompetence(Competence $lsCompetence): self
    {
        if (!$this->lsCompetences->contains($lsCompetence)) {
            $this->lsCompetences[] = $lsCompetence;
            $lsCompetence->setCv($this);
        }

        return $this;
    }

    public function removeLsCompetence(Competence $lsCompetence): self
    {
        if ($this->lsCompetences->removeElement($lsCompetence)) {
            // set the owning side to null (unless already changed)
            if ($lsCompetence->getCv() === $this) {
                $lsCompetence->setCv(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
