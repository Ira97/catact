<?php

namespace App\Entity;

use App\Repository\GenderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GenderRepository::class)
 */
class Gender
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
    private $name_gender;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameGender(): ?string
    {
        return $this->name_gender;
    }

    public function setNameGender(?string $name_gender): self
    {
        $this->name_gender = $name_gender;

        return $this;
    }
}
