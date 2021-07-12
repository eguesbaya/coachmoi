<?php

namespace App\Entity;

class SearchBooking
{
    private ?BookingStatus $status = null;

    public function getStatus(): ?BookingStatus
    {
        return $this->status;
    }

    public function setStatus(?BookingStatus $status): self
    {
        $this->status = $status;
        return $this;
    }
}
