<?php

namespace App\Entity;

use DateTime;
use DateTimeImmutable;
use App\Entity\Coach;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ActivityRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ActivityRepository::class)
 * @Vich\Uploadable
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
    private ?string $photo = null;

    /**
    * @Vich\UploadableField(mapping="activities", fileNameProperty="photo")
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
     * @ORM\Column(type="boolean", nullable="true")
     */
    private bool $isFeatured;

    /**
    * @ORM\OneToMany(targetEntity=Client::class, mappedBy="activity")
    */
    private Collection $clients;

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
     * @return Collection|Client[]
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
            $client->setActivity($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getActivity() === $this) {
                $client->setActivity(null);
            }
        }

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
