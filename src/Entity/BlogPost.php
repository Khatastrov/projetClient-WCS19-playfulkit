<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlogPostRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class BlogPost
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="blogPosts")
     */
    private $author;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $creationDate;

    /**
     * @ORM\Column(type="datetimetz", nullable=true)
     */
    private $modificationDate;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    /**
     * @ORM\PrePersist()
     */
    public function setCreationDate(): self
    {
        $this->creationDate = new \DateTime();

        return $this;
    }

    public function getModificationDate(): ?\DateTimeInterface
    {
        return $this->modificationDate;
    }

    /**
     * @ORM\PreUpdate()
     */
    public function setModificationDate(): self
    {
        $this->modificationDate = new \DateTime();

        return $this;
    }
}
