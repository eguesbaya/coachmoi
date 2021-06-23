<?php

namespace App\Entity;

use App\Repository\TrainingSpaceRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\SpaceCategory;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrainingSpaceRepository::class)
 */
class TrainingSpace
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
     * @ORM\Column(type="string", length=255)
     */
    private string $address;

    /*
     * @ORM\ManyToOne(targetEntity=SpaceCategory::class, inversedBy="trainingSpaces")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?SpaceCategory $spaceCategory;

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

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getSpaceCategory(): ?SpaceCategory
    {
        return $this->spaceCategory;
    }

    public function setSpaceCategory(?SpaceCategory $spaceCategory): self
    {
        $this->spaceCategory = $spaceCategory;

        return $this;
    }
}
