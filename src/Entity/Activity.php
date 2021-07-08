<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Coach;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ActivityRepository::class)
 */
class Activity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    private ?string $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank()
     * @Assert\Length(max="700")
     */

    private ?string $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max="255")
     */
    private ?string $photo;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isFeatured;

    /**
     * @ORM\ManyToMany(targetEntity=Coach::class, mappedBy="activities")
     */
    private Collection $coaches;

    /**
     * @ORM\ManyToMany(targetEntity=TrainingSpace::class, mappedBy="activity")
     */
    private Collection $trainingSpaces;

    public function __construct()
    {
        $this->coaches = new ArrayCollection();
        $this->trainingSpaces = new ArrayCollection();
    }

    public function __serialize(): array
    {
        return [];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

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

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getIsFeatured(): ?bool
    {
        return $this->isFeatured;
    }

    public function setIsFeatured(bool $isFeatured): self
    {
        $this->isFeatured = $isFeatured;

        return $this;
    }

    /**
     * @return Collection|Coach[]
     */
    public function getCoaches(): Collection
    {
        return $this->coaches;
    }

    public function addCoach(Coach $coach): self
    {
        if (!$this->coaches->contains($coach)) {
            $this->coaches[] = $coach;
            $coach->addActivity($this);
        }

        return $this;
    }

    public function removeCoach(Coach $coach): self
    {
        if ($this->coaches->removeElement($coach)) {
            $coach->removeActivity($this);
        }

        return $this;
    }

    /**
     * @return Collection|TrainingSpace[]
     */
    public function getTrainingSpaces(): Collection
    {
        return $this->trainingSpaces;
    }

    public function addTrainingSpace(TrainingSpace $trainingSpace): self
    {
        if (!$this->trainingSpaces->contains($trainingSpace)) {
            $this->trainingSpaces[] = $trainingSpace;
            $trainingSpace->addActivity($this);
        }

        return $this;
    }

    public function removeTrainingSpace(TrainingSpace $trainingSpace): self
    {
        if ($this->trainingSpaces->removeElement($trainingSpace)) {
            $trainingSpace->removeActivity($this);
        }

        return $this;
    }
}
