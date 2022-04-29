<?php

namespace App\Entity;

use App\Repository\OptionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OptionsRepository::class)]
class Options
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToMany(targetEntity: Properties::class, inversedBy: 'option')]
    private $house;

    public function __construct()
    {
        $this->house = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Properties>
     */
    public function getHouse(): Collection
    {
        return $this->house;
    }

    public function addHouse(Properties $house): self
    {
        if (!$this->house->contains($house)) {
            $this->house[] = $house;
        }

        return $this;
    }

    public function removeHouse(Properties $house): self
    {
        $this->house->removeElement($house);

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }
}
