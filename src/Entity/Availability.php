<?php

namespace App\Entity;

use App\Entity\Coach;
use App\Entity\Client;
use DateTimeInterface;
use App\Entity\TrainingSpace;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AvailabilityRepository;

/**
 * @ORM\Entity(repositoryClass=AvailabilityRepository::class)
 */
class Availability
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $weekday;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $startTime;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $endTime;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="availabilities")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Client $client;

    /**
     * @ORM\ManyToOne(targetEntity=Coach::class, inversedBy="availabilities")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Coach $coach;

    /**
     * @ORM\ManyToOne(targetEntity=TrainingSpace::class, inversedBy="availabilities")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?TrainingSpace $trainingSpace;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWeekday(): string
    {
        return $this->weekday;
    }

    public function setWeekday(string $weekday): self
    {
        $this->weekday = $weekday;

        return $this;
    }

    public function getStartTime(): \DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): \DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(\DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getCoach(): ?Coach
    {
        return $this->coach;
    }

    public function setCoach(?Coach $coach): self
    {
        $this->coach = $coach;

        return $this;
    }

    public function getTrainingSpace(): ?TrainingSpace
    {
        return $this->trainingSpace;
    }

    public function setTrainingSpace(?TrainingSpace $trainingSpace): self
    {
        $this->trainingSpace = $trainingSpace;

        return $this;
    }
}
