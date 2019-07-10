<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InterestedPeopleRepository")
 * @UniqueEntity("email")
 * @ORM\HasLifecycleCallbacks()
 */
class InterestedPeople
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Email(
     *     message = "L'email que tu as saisi ({{ value }}) ne semble pas correct.",
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $registerDate;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getRegisterDate(): ?\DateTimeInterface
    {
        return $this->registerDate;
    }

    /**
     * @ORM\PrePersist()
     */
    public function setRegisterDate()
    {
        $this->registerDate = new \DateTime();

        return $this;
    }
}
