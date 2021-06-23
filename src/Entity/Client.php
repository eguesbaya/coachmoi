<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClientRepository;

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
     * @ORM\Column(type="date")
     */
    private \DateTimeInterface $birthdate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $address;

    /**
     * @ORM\Column(type="text")
     */
    private string $goal;

    /**
     * @ORM\Column(type="integer")
     */
    private int $budget;

    /**
     * @ORM\Column(type="integer")
     */
    private int $groupSize;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isApt = true;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private User $user;

    /**
     * @ORM\ManyToOne(targetEntity=Activity::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private Activity $activity;

    /**
     * @ORM\ManyToOne(targetEntity=PracticeLevel::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private PracticeLevel $practiceLevel;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getGoal(): ?string
    {
        return $this->goal;
    }

    public function setGoal(string $goal): self
    {
        $this->goal = $goal;

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

    public function setIsApt(bool $isApt): self
    {
        $this->isApt = $isApt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getActivity(): ?Activity
    {
        return $this->activity;
    }

    public function setActivity(Activity $activity): self
    {
        $this->activity = $activity;

        return $this;
    }

    public function getPracticeLevel(): ?PracticeLevel
    {
        return $this->practiceLevel;
    }

    public function setPracticeLevel(PracticeLevel $practiceLevel): self
    {
        $this->practiceLevel = $practiceLevel;

        return $this;
    }
}
