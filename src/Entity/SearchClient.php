<?php

namespace App\Entity;

class SearchClient
{
    private ?string $user = '';

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
}
