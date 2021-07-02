<?php

namespace App\Entity;

use App\Repository\AvailabilityRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;

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
     * @ORM\ManyToOne(targetEntity=Weekday::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Weekday $weekday;

    /**
    * @ORM\Column(type="time")
    * A "H:i" formatted value
    */
    private ?DateTimeInterface $startTime;

    /**
    * @ORM\Column(type="time")
    * A "H:i" formatted value
    * @Assert\Expression(
    * "this.getStartTime() < this.getEndTime()",
    * message="L'heure de fin ne doit pas être antérieure à l'heure début"
    * )
    */
    private ?DateTimeInterface $endTime;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="availabilities")
     */
    private ?Client $client;

    /**
     * @ORM\ManyToOne(targetEntity=Coach::class, inversedBy="availabilities")
     */
    private ?Coach $coach;

    /**
     * @ORM\ManyToOne(targetEntity=TrainingSpace::class, inversedBy="availabilities")
     */
    private ?TrainingSpace $trainingSpace;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWeekday(): ?Weekday
    {
        return $this->weekday;
    }

    public function setWeekday(?Weekday $weekday): self
    {
        $this->weekday = $weekday;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
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
