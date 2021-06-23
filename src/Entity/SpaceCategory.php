<?php

namespace App\Entity;

use App\Repository\SpaceCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\TrainingSpace;

/**
 * @ORM\Entity(repositoryClass=SpaceCategoryRepository::class)
 */
class SpaceCategory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $photo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\OneToMany(targetEntity=TrainingSpace::class, mappedBy="spaceCategory", orphanRemoval=true)
     */
    private Collection $trainingSpaces;

    public function __construct()
    {
        $this->trainingSpaces = new ArrayCollection();
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

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

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
            $trainingSpace->setSpaceCategory($this);
        }

        return $this;
    }

    public function removeTrainingSpace(TrainingSpace $trainingSpace): self
    {
        if ($this->trainingSpaces->removeElement($trainingSpace)) {
            // set the owning side to null (unless already changed)
            if ($trainingSpace->getSpaceCategory() === $this) {
                $trainingSpace->setSpaceCategory(null);
            }
        }

        return $this;
    }
}
