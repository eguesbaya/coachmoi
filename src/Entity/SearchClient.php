<?php

namespace App\Entity;

class SearchClient
{
    private ?string $user = '';

    private ?string $lastname = '';

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
     * Get the value of user
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     */
    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }
}
