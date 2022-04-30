<?php

namespace App\Entity;

class Search {
    
    private $minrooms;

    private $maxrooms;

    private $minsurface;

    private $maxsurface;

    private $minprice;

    private $maxprice;


    /**
     * Get the value of minrooms
     */
    public function getMinrooms(): ?int
    {
        return $this->minrooms;
    }

    /**
     * Set the value of minrooms
     */
    public function setMinrooms(int $minrooms): self
    {
        $this->minrooms = $minrooms;

        return $this;
    }

    /**
     * Get the value of maxrooms
     */
    public function getMaxrooms(): ?int
    {
        return $this->maxrooms;
    }

    /**
     * Set the value of maxrooms
     */
    public function setMaxrooms(int $maxrooms): self
    {
        $this->maxrooms = $maxrooms;

        return $this;
    }

    /**
     * Get the value of minsurface
     */
    public function getMinsurface(): ?int
    {
        return $this->minsurface;
    }

    /**
     * Set the value of minsurface
     */
    public function setMinsurface(int $minsurface): self
    {
        $this->minsurface = $minsurface;

        return $this;
    }

    /**
     * Get the value of maxsurface
     */
    public function getMaxsurface(): ?int
    {
        return $this->maxsurface;
    }

    /**
     * Set the value of maxsurface
     */
    public function setMaxsurface(int $maxsurface): self
    {
        $this->maxsurface = $maxsurface;

        return $this;
    }

    /**
     * Get the value of minprice
     */
    public function getMinprice(): ?int
    {
        return $this->minprice;
    }

    /**
     * Set the value of minprice
     */
    public function setMinprice(int $minprice): self
    {
        $this->minprice = $minprice;

        return $this;
    }

    /**
     * Get the value of maxprice
     */
    public function getMaxprice(): ?int
    {
        return $this->maxprice;
    }

    /**
     * Set the value of maxprice
     */
    public function setMaxprice(int $maxprice): self
    {
        $this->maxprice = $maxprice;

        return $this;
    }

    public function __toString()
    {
        return '0';
    }
}

