<?php

namespace App\Entity;

use PhpParser\Builder\Property;
use Symfony\Component\Validator\Constraints as Assert;

class Contact {

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters")
     */
    private $firstname;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your last name must be at least {{ limit }} characters long",
     *      maxMessage = "Your last name cannot be longer than {{ limit }} characters")
     */
    private $lastname;

    /**
     * @Assert\NotBlank
     * @Assert\Email(
     *     message = "'{{ value }}' is not a valid email.")
     */
    private $email;

    /**
     * @Assert\NotBlank
     * @Assert\Regex(
     *      pattern="/[0-9]{10}/",
     *      message = "'{{ value }}' is not a valid phone number.")
     */
    private $phone;

    /**
     * @var string A "Y-m-d" formatted value
     * 
     * @Assert\NotBlank
     * @Assert\Date
     */
    private $date;

    /**
     * @var string A "H:i:s" formatted value
     * 
     * @Assert\NotBlank
     * @Assert\Time
     */
    private $time;

    /**
     * @var Property|null
     */
    private $property;

    /**
     * Get the value of firstname
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     */
    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of phone
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of date
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * Set the value of date
     */
    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of time
     */
    public function getTime(): ?string
    {
        return $this->time;
    }

    /**
     * Set the value of time
     */
    public function setTime(string $time): self
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get the value of property
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Set the value of property
     */
    public function setProperty($property): self
    {
        $this->property = $property;

        return $this;
    }
}