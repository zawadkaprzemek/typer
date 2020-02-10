<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event
{
    use TimestampableEntity;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EventType", inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $result;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $eventDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserBet", mappedBy="event")
     */
    private $userBets;

    public function __construct()
    {
        $this->userBets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?EventType
    {
        return $this->type;
    }

    public function setType(?EventType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setResult(?string $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getEventDate(): ?\DateTimeInterface
    {
        return $this->eventDate;
    }

    public function setEventDate(?\DateTimeInterface $eventDate): self
    {
        $this->eventDate = $eventDate;

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
            $userBet->setEvent($this);
        }

        return $this;
    }

    public function removeUserBet(UserBet $userBet): self
    {
        if ($this->userBets->contains($userBet)) {
            $this->userBets->removeElement($userBet);
            // set the owning side to null (unless already changed)
            if ($userBet->getEvent() === $this) {
                $userBet->setEvent(null);
            }
        }

        return $this;
    }
}
