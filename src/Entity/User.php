<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Rollerworks\Component\PasswordStrength\Validator\Constraints as RollerworksPassword;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="W serwisie istnieje konto z takim adresem Email")
 * @UniqueEntity(fields="username", message="Podana nazwa użytkownika jest zajęta")
 */
class User implements UserInterface
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

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
     * @RollerworksPassword\PasswordRequirements(
     *     requireLetters=true,
     *     requireNumbers=true,
     *     requireCaseDiff=true,
     *     tooShortMessage="Hasło musi posiadać conajmniej 8 znaków",
     *     missingLettersMessage="Hasło musi zawierać conajmniej jedną małą i dużą literę",
     *     requireCaseDiffMessage="Hasło musi zawierać conajmniej jedną małą i dużą literę",
     *     missingNumbersMessage="Hasło musi zawierać conajmniej jedną cyfrę")
     * @Assert\NotBlank
     * @Assert\Length(
     *     max=4096,
     *     groups = {"Default"}
     * )
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserType")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserBet", mappedBy="user")
     */
    private $userBets;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="boolean")
     */
    private $blocked=false;

    /**
     * @Assert\Image(mimeTypes={ "image/*" })
     */
    private $image;

    public function __construct()
    {
        $this->userBets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        $roles[] = 'ROLE_'.strtoupper($this->getType()->getName());
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

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getType(): ?UserType
    {
        return $this->type;
    }

    public function setType(?UserType $type): self
    {
        $this->type = $type;

        return $this;
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
     * @return Collection|UserBet[]
     */
    public function getUserBets(): Collection
    {
        return $this->userBets;
    }

    public function addUserBet(UserBet $userBet): self
    {
        if (!$this->userBets->contains($userBet)) {
            $this->userBets[] = $userBet;
            $userBet->setUser($this);
        }

        return $this;
    }

    public function removeUserBet(UserBet $userBet): self
    {
        if ($this->userBets->contains($userBet)) {
            $this->userBets->removeElement($userBet);
            // set the owning side to null (unless already changed)
            if ($userBet->getUser() === $this) {
                $userBet->setUser(null);
            }
        }

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBlocked(): ?bool
    {
        return $this->blocked;
    }

    public function setBlocked(bool $blocked): self
    {
        $this->blocked = $blocked;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }
}
