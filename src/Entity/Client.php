<?php

namespace App\Entity;

use DateTimeInterface;
use App\Entity\CoachBooking;
use App\Entity\PracticeLevel;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="client", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */

    private User $user;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $goal;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $budget;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $groupSize;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $isApt;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private ?\DateTimeInterface $birthdate = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $address = null;

    /**
     * @ORM\ManyToOne(targetEntity=PracticeLevel::class, inversedBy="clients")
     * @ORM\JoinColumn(nullable=true)
     */
    private ?PracticeLevel $practiceLevel;

    /**
     * @ORM\OneToMany(targetEntity=Availability::class, mappedBy="client")
     */
    private Collection $availabilities;


    /**
     * @ORM\ManyToOne(targetEntity=Activity::class)
     * @ORM\JoinColumn(nullable=false)
     */

    private Activity $activity;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private ?\DateTimeInterface $createdAt = null;

    /**
     * @ORM\OneToOne(targetEntity=CoachBooking::class, mappedBy="client", cascade={"persist", "remove"})
     */
    private ?CoachBooking $coachBooking;

    public function __construct()
    {
        $this->availabilities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getGoal(): ?string
    {
        return $this->goal;
    }

    public function setGoal(string $goal): void
    {
        $this->goal = $goal;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getBudget(): ?int
    {
        return $this->budget;
    }

    public function setBudget(int $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getGroupSize(): ?int
    {
        return $this->groupSize;
    }

    public function setGroupSize(int $groupSize): self
    {
        $this->groupSize = $groupSize;

        return $this;
    }

    public function isApt(): ?bool
    {
        return $this->isApt;
    }

    public function setIsApt(bool $isApt): void
    {
        $this->isApt = $isApt;
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

    public function getPracticeLevel(): ?PracticeLevel
    {
        return $this->practiceLevel;
    }

    public function setPracticeLevel(?PracticeLevel $practiceLevel): self
    {
        $this->practiceLevel = $practiceLevel;

        return $this;
    }

    /**
     * @return Collection|Availability[]
     */
    public function getAvailabilities(): Collection
    {
        return $this->availabilities;
    }

    public function addAvailability(Availability $availability): self
    {
        if (!$this->availabilities->contains($availability)) {
            $this->availabilities[] = $availability;
            $availability->setClient($this);
        }

        return $this;
    }

    public function removeAvailability(Availability $availability): self
    {
        if ($this->availabilities->removeElement($availability)) {
            // set the owning side to null (unless already changed)
            if ($availability->getClient() === $this) {
                $availability->setClient(null);
            }
        }

        return $this;
    }

    public function getActivity(): Activity
    {
        return $this->activity;
    }

    public function setActivity(Activity $activity): self
    {
        $this->activity = $activity;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCoachBooking(): ?CoachBooking
    {
        return $this->coachBooking;
    }

    public function setCoachBooking(CoachBooking $coachBooking): self
    {
        // set the owning side of the relation if necessary
        if ($coachBooking->getClient() !== $this) {
            $coachBooking->setClient($this);
        }

        $this->coachBooking = $coachBooking;

        return $this;
    }
}
