<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomComplet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pass;

    /**
     * @ORM\Column(type="boolean")
     */
    private $profilePublic;

    /**
     * @ORM\OneToMany(targetEntity=CollectionProfiles::class, mappedBy="ustilisateur")
     */
    private $collectionProfiles;

    /**
     * @ORM\OneToMany(targetEntity=Cv::class, mappedBy="user")
     */
    private $lsCv;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $activeCv;



    public function __construct()
    {
        $this->lsEtud = new ArrayCollection();
        $this->collectionProfiles = new ArrayCollection();
        $this->lsCv = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPass(): ?string
    {
        return $this->pass;
    }

    public function setPass(string $pass): self
    {
        $this->pass = $pass;

        return $this;
    }

    public function getProfilePublic(): ?bool
    {
        return $this->profilePublic;
    }

    public function setProfilePublic(bool $profilePublic): self
    {
        $this->profilePublic = $profilePublic;

        return $this;
    }

    /**
     * @return Collection|CollectionProfiles[]
     */
    public function getCollectionProfiles(): Collection
    {
        return $this->collectionProfiles;
    }

    public function addCollectionProfile(CollectionProfiles $collectionProfile): self
    {
        if (!$this->collectionProfiles->contains($collectionProfile)) {
            $this->collectionProfiles[] = $collectionProfile;
            $collectionProfile->setUstilisateur($this);
        }

        return $this;
    }

    public function removeCollectionProfile(CollectionProfiles $collectionProfile): self
    {
        if ($this->collectionProfiles->removeElement($collectionProfile)) {
            // set the owning side to null (unless already changed)
            if ($collectionProfile->getUstilisateur() === $this) {
                $collectionProfile->setUstilisateur(null);
            }
        }

        return $this;
    }

    public function setCollectionProfiles(?CollectionProfiles $collectionProfiles): self
    {
        $this->collectionProfiles = $collectionProfiles;

        return $this;
    }

    /**
     * @return Collection|Cv[]
     */
    public function getLsCv(): Collection
    {
        return $this->lsCv;
    }

    public function addLsCv(Cv $lsCv): self
    {
        if (!$this->lsCv->contains($lsCv)) {
            $this->lsCv[] = $lsCv;
            $lsCv->setUser($this);
        }

        return $this;
    }

    public function removeLsCv(Cv $lsCv): self
    {
        if ($this->lsCv->removeElement($lsCv)) {
            // set the owning side to null (unless already changed)
            if ($lsCv->getUser() === $this) {
                $lsCv->setUser(null);
            }
        }

        return $this;
    }

    public function getActiveCv(): ?int
    {
        return $this->activeCv;
    }

    public function setActiveCv(?int $activeCv): self
    {
        $this->activeCv = $activeCv;

        return $this;
    }

}
