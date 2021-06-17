<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @var string
 */

class Contact
{
    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez remplir ce champ s'il vous plait")
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Votre nom ne peut pas dépasser {{ limit }} caractères"
     * )
     */
    private $lastname;

    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez remplir ce champ s'il vous plait.")
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Votre prénom ne peut pas dépasser {{ limit }} caractères"
     * )
     */
     private $firstname;

    /**
     * @var string
     * @Assert\Email(
     *     message = "L'email '{{ value }}' n'est pas valide."
     * )
     * @Assert\NotBlank(message="Veuillez remplir ce champ s'il vous plait.")
     */
    private $email;

    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez remplir ce champ s'il vous plait.")
     * @Assert\Length(
     *      max = 20,
     *      maxMessage = "Saisissez un maximum de 20 chiffres"
     * )
     *  @Assert\Regex(pattern="/^[0-9]*$/", message="Veuillez saisir seulement des chiffres")
     */
    private $phone;

    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez remplir ce champ s'il vous plait.")
     */
    private $message;


    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
