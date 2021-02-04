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
     * @ORM\ManyToMany(targetEntity=Competence::class)
     */
    private $lsCompetences;

    /**
     * @ORM\ManyToMany(targetEntity=Formation::class)
     */
    private $lsFormations;

    /**
     * @ORM\ManyToMany(targetEntity=ExperiencePro::class)
     */
    private $lsExperiencesPro;

    /**
     * @ORM\ManyToOne(targetEntity=Etudiant::class, inversedBy="lsCvs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etudiant;

    /**
     * @ORM\OneToOne(targetEntity=Etudiant::class, mappedBy="activeCV", cascade={"persist", "remove"})
     */
    private $etudiantActif;

    public function __construct()
    {
        $this->lsCompetences = new ArrayCollection();
        $this->lsFormations = new ArrayCollection();
        $this->lsExperiencesPro = new ArrayCollection();
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
        }

        return $this;
    }

    public function removeLsCompetence(Competence $lsCompetence): self
    {
        $this->lsCompetences->removeElement($lsCompetence);

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
        }

        return $this;
    }

    public function removeLsFormation(Formation $lsFormation): self
    {
        $this->lsFormations->removeElement($lsFormation);

        return $this;
    }

    /**
     * @return Collection|ExperiencePro[]
     */
    public function getLsExperiencesPro(): Collection
    {
        return $this->lsExperiencesPro;
    }

    public function addLsExperiencesPro(ExperiencePro $lsExperiencesPro): self
    {
        if (!$this->lsExperiencesPro->contains($lsExperiencesPro)) {
            $this->lsExperiencesPro[] = $lsExperiencesPro;
        }

        return $this;
    }

    public function removeLsExperiencesPro(ExperiencePro $lsExperiencesPro): self
    {
        $this->lsExperiencesPro->removeElement($lsExperiencesPro);

        return $this;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    public function getEtudiantActif(): ?Etudiant
    {
        return $this->etudiantActif;
    }

    public function setEtudiantActif(Etudiant $etudiantActif): self
    {
        // set the owning side of the relation if necessary
        if ($etudiantActif->getActiveCV() !== $this) {
            $etudiantActif->setActiveCV($this);
        }

        $this->etudiantActif = $etudiantActif;

        return $this;
    }
}
