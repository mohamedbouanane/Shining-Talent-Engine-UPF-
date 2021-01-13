<?php

namespace App\Entity;

use App\Repository\CollectionProfilesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CollectionProfilesRepository::class)
 */
class CollectionProfiles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="collectionProfiles")
     */
    private $ustilisateur;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="collectionProfiles")
     */
    private $lsEtud;

    public function __construct()
    {
        $this->lsEtud = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUstilisateur(): ?User
    {
        return $this->ustilisateur;
    }

    public function setUstilisateur(?User $ustilisateur): self
    {
        $this->ustilisateur = $ustilisateur;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getLsEtud(): Collection
    {
        return $this->lsEtud;
    }

    public function addLsEtud(User $lsEtud): self
    {
        if (!$this->lsEtud->contains($lsEtud)) {
            $this->lsEtud[] = $lsEtud;
            $lsEtud->setCollectionProfiles($this);
        }

        return $this;
    }

    public function removeLsEtud(User $lsEtud): self
    {
        if ($this->lsEtud->removeElement($lsEtud)) {
            // set the owning side to null (unless already changed)
            if ($lsEtud->getCollectionProfiles() === $this) {
                $lsEtud->setCollectionProfiles(null);
            }
        }

        return $this;
    }


}
