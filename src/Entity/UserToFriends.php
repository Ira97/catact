<?php

namespace App\Entity;

use App\Repository\UserToFriendsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserToFriendsRepository::class)
 */
class UserToFriends
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $User;

    /**
     * @ORM\Column(type="integer")
     */
    private $Friend;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?int
    {
        return $this->User;
    }

    public function setUser(int $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getFriend(): ?int
    {
        return $this->Friend;
    }

    public function setFriend(int $Friend): self
    {
        $this->Friend = $Friend;
        return $this;
    }
}
