<?php

namespace App\Entity;

use App\Entity\Client;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PracticeLevelRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=PracticeLevelRepository::class)
 */
class PracticeLevel
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
    private string $level;

    /**
    * @ORM\OneToMany(targetEntity=Client::class, mappedBy="practiceLevel")
    */
    private Collection $clients;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
    }

    public function __sleep(): array
    {
        return [];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): self
    {
        $this->level = $level;

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
            $client->setPracticeLevel($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getPracticeLevel() === $this) {
                $client->setPracticeLevel(null);
            }
        }

        return $this;
    }
}
