<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PropertiesRepository;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: PropertiesRepository::class)]
class Properties
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'integer')]
    private $surface;

    #[ORM\Column(type: 'integer')]
    private $price;

    #[ORM\Column(type: 'integer', length: 255)]
    private $floors;

    #[ORM\Column(type: 'integer')]
    private $rooms;

    #[ORM\Column(type: 'string', length: 255)]
    private $city;

    #[ORM\Column(type: 'string', length: 255)]
    private $type;

    #[ORM\Column(type: 'string', length: 255)]
    private $transactiontype;

    #[ORM\Column(type: 'string', length: 255)]
    private $slug;

    #[ORM\Column(type: 'string', length: 255)]
    private string|File $photo;

    #[ORM\ManyToMany(targetEntity: Options::class, mappedBy: 'house')]
    private $option;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $status;

    public function __construct()
    {
        $this->option = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getFloors(): ?int
    {
        return $this->floors;
    }

    public function setFloors(int $floors): self
    {
        $this->floors = $floors;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getTransactiontype(): ?string
    {
        return $this->transactiontype;
    }

    public function setTransactiontype(string $transactiontype): self
    {
        $this->transactiontype = $transactiontype;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get the value of photo
     *
     * @return string|File
     */
    public function getPhoto(): string|File
    {
        return $this->photo;
    }

    /**
     * Set the value of photo
     *
     * @param string|File $photo
     *
     * @return self
     */
    public function setPhoto(string|File $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    public function setRooms(int $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    /**
     * @return Collection<int, Options>
     */
    public function getOption(): Collection
    {
        return $this->option;
    }

    public function addOption(Options $option): self
    {
        if (!$this->option->contains($option)) {
            $this->option[] = $option;
            $option->addHouse($this);
        }

        return $this;
    }

    public function removeOption(Options $option): self
    {
        if ($this->option->removeElement($option)) {
            $option->removeHouse($this);
        }

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}
