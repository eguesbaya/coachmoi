<?php

namespace App\Entity;

use App\Repository\BookingStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookingStatusRepository::class)
 */
class BookingStatus
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
    private ?string $status;

    /**
     * @ORM\OneToMany(targetEntity=CoachBooking::class, mappedBy="bookingStatus", orphanRemoval=true)
     */
    private Collection $coachBookings;

    public function __construct()
    {
        $this->coachBookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

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
            $coachBooking->setBookingStatus($this);
        }

        return $this;
    }

    public function removeCoachBooking(CoachBooking $coachBooking): self
    {
        if ($this->coachBookings->removeElement($coachBooking)) {
            // set the owning side to null (unless already changed)
            if ($coachBooking->getBookingStatus() === $this) {
                $coachBooking->setBookingStatus(null);
            }
        }

        return $this;
    }
}
