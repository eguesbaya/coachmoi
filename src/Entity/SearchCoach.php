<?php

namespace App\Entity;

class SearchCoach
{
    private ?string $user = '';

    private ?Activity $activity = null;

    /**
     * Get the value of user
     */
    public function getUser(): ?string
    {
        return $this->user;
    }

    /**
     * Set the value of lastname
     */
    public function setUser(?string $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of activity
     */
    public function getActivity(): ?Activity
    {
        return $this->activity;
    }

    /**
     * Set the value of activity
     *
     * @return  self
     */
    public function setActivity(?Activity $activity): self
    {
        $this->activity = $activity;

        return $this;
    }
}
