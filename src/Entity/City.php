<?php

namespace App\Entity;

use App\Repository\CityRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=CityRepository::class)
 */
class City
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name_city;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCity(): ?string
    {
        return $this->name_city;
    }

    public function setNameCity(?string $name_city): self
    {
        $this->name_city = $name_city;

        return $this;
    }
}
