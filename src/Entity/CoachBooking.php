<?php

namespace App\Entity;

use App\Repository\CoachBookingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoachBookingRepository::class)
 */
class CoachBooking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;


    /**
     * @ORM\ManyToOne(targetEntity=Coach::class)
     */
    private ?Coach $coach;

    /**
     * @ORM\OneToOne(targetEntity=Client::class, inversedBy="coachBooking", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Client $client;

    /**
     * @ORM\ManyToOne(targetEntity=TrainingSpace::class)
     */
    private ?TrainingSpace $trainingSpace;

       public function __sleep(): array
    {
        return [];
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(Client $client): self
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
