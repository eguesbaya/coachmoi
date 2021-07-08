<?php

namespace App\Entity;

use DateTime;
use App\Entity\User;
use DateTimeImmutable;
use App\Entity\Activity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CoachRepository::class)
 *  @Vich\Uploadable
 */
class Coach
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
     * @ORM\Column(type="boolean")
     */
    private ?bool $hasVehicle;

    /**
     * @ORM\Column(type="text")
     */
    private string $qualification;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $equipment;

    /**
     * @ORM\Column(type="text")
     */
    private string $biography;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $hourlyRate;

    /**
    * @Vich\UploadableField(mapping="coaches", fileNameProperty="photo")
    * @Assert\File(
    *      maxSize = "2M",
    *      mimeTypes = {
    *              "image/jpg", "image/jpg",
    *              "image/jpeg", "image/jpeg",
    *              "imaes/png", "image/webp"},
    * )
    * @var File|null
    */
    private $photoFile;

   /**
    * @ORM\Column(type="string", length=255)
    * @var string
    */
    private ?string $photo = "";

   /**
    * @ORM\Column(type="datetime", nullable="true")
    * @var \DateTimeInterface|null
    */
    private $updatedAt;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="coach", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */

    private User $user;

    /**
     * @ORM\ManyToMany(targetEntity=Activity::class, inversedBy="coaches")
     */
    private Collection $activities;

    /**
     * @ORM\OneToMany(targetEntity=Availability::class, mappedBy="coach")
     */
    private Collection $availabilities;

    /**
     * @ORM\OneToMany(targetEntity=CoachBooking::class, mappedBy="coach")
     */
    private Collection $coachBookings;

    public function __sleep(): array
    {
        return [];
    }

    public function __construct()
    {
        $this->activities = new ArrayCollection();
        $this->availabilities = new ArrayCollection();
        $this->coachBookings = new ArrayCollection();
    }

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

    public function getHasVehicle(): ?bool
    {
        return $this->hasVehicle;
    }

    public function setHasVehicle(bool $hasVehicle): self
    {
        $this->hasVehicle = $hasVehicle;

        return $this;
    }

    public function getQualification(): ?string
    {
        return $this->qualification;
    }

    public function setQualification(string $qualification): self
    {
        $this->qualification = $qualification;

        return $this;
    }

    public function getEquipment(): ?string
    {
        return $this->equipment;
    }

    public function setEquipment(?string $equipment): self
    {
        $this->equipment = $equipment;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }

    public function getHourlyRate(): ?int
    {
        return $this->hourlyRate;
    }

    public function setHourlyRate(int $hourlyRate): self
    {
        $this->hourlyRate = $hourlyRate;

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

    /**
     * @return Collection|Activity[]
     */
    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivity(Activity $activity): self
    {
        if (!$this->activities->contains($activity)) {
            $this->activities[] = $activity;
        }

        return $this;
    }

    public function removeActivity(Activity $activity): self
    {
        $this->activities->removeElement($activity);

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
            $availability->setCoach($this);
        }

        return $this;
    }

    public function removeAvailability(Availability $availability): self
    {
        if ($this->availabilities->removeElement($availability)) {
            // set the owning side to null (unless already changed)
            if ($availability->getCoach() === $this) {
                $availability->setCoach(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CoachBooking[]
     */
    public function getCoachBookings(): Collection
    {
        return $this->coachBookings;
    }

    public function addCoachBooking(CoachBooking $coachBooking): self
    {
        if (!$this->coachBookings->contains($coachBooking)) {
            $this->coachBookings[] = $coachBooking;
            $coachBooking->setCoach($this);
        }

        return $this;
    }

    public function removeCoachBooking(CoachBooking $coachBooking): self
    {
        if ($this->coachBookings->removeElement($coachBooking)) {
            // set the owning side to null (unless already changed)
            if ($coachBooking->getCoach() === $this) {
                $coachBooking->setCoach(null);
            }
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
