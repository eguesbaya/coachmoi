<?php

namespace App\Entity;

use DateTime;
use DateTimeImmutable;
use App\Repository\TrainingSpaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\SpaceCategory;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=TrainingSpaceRepository::class)
 * @Vich\Uploadable
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
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    private ?string $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $photo = null;

    /**
    * @Vich\UploadableField(mapping="spacetrainings", fileNameProperty="photo")
    * @Assert\File(
    *      maxSize = "2M",
    *      mimeTypes = {
    *              "image/jpg", "image/jpg",
    *              "image/jpeg", "image/jpeg",
    *              "image/png", "image/webp"},
    * )
    * @var File|null
    */
    private $photoFile;

   /**
    * @ORM\Column(type="datetime", nullable="true")
    * @var \DateTimeInterface|null
    */
    private $updatedAt;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    private string $address;

    /**
     * @ORM\ManyToOne(targetEntity=SpaceCategory::class, inversedBy="trainingSpaces")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?SpaceCategory $spaceCategory;

    /**
     * @ORM\OneToMany(targetEntity=Availability::class, mappedBy="trainingSpace", orphanRemoval=true)
     */
    private Collection $availabilities;

    /**
     * @ORM\ManyToMany(targetEntity=Activity::class, inversedBy="trainingSpaces")
     */
    private Collection $activity;

    public function __construct()
    {
        $this->availabilities = new ArrayCollection();
        $this->activity = new ArrayCollection();
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
            $availability->setTrainingSpace($this);
        }

        return $this;
    }

    public function removeAvailability(Availability $availability): self
    {
        if ($this->availabilities->removeElement($availability)) {
            // set the owning side to null (unless already changed)
            if ($availability->getTrainingSpace() === $this) {
                $availability->setTrainingSpace(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Activity[]
     */
    public function getActivity(): Collection
    {
        return $this->activity;
    }

    public function addActivity(Activity $activity): self
    {
        if (!$this->activity->contains($activity)) {
            $this->activity[] = $activity;
        }

        return $this;
    }

    public function removeActivity(Activity $activity): self
    {
        $this->activity->removeElement($activity);

        return $this;
    }

    public function setPhotoFile(?File $photo): self
    {
        $this->photoFile = $photo;
        $this->updatedAt = new DateTimeImmutable('now');
        return $this;
    }

    public function getPhotoFile(): ?File
    {
        return $this->photoFile;
    }


    public function setPhoto(?string $photo): void
    {
        $this->photo = $photo;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt = null): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
