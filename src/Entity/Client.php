<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

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

    private User $user;

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
    private bool $isApt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

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

    public function getIsApt(): ?bool
    {
        return $this->isApt;
    }

    public function setIsApt(bool $isApt): self
    {
        $this->isApt = $isApt;

        return $this;
    }
}
