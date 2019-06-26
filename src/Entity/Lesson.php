<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LessonRepository")
 */
class Lesson
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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="lessons")
     * @ORM\JoinColumn(nullable=true)
     */
    private $author;

    /**
     * @ORM\Column(type="datetimetz", nullable=true)
     */
    private $publicationDate;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $illustration;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="lessons")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tool", inversedBy="lessons")
     * @ORM\JoinColumn(name="tool_id", referencedColumnName="id")
     */
    private $Tool;

    public function __construct()
    {
        $this->publicationDate = new \DateTime();
        $this->Tool = new ArrayCollection();
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function addTool(Tool $tool): self
    {
        if (!$this->tool->contains($tool)) {
            $this->tool[] = $tool;
            $tool->setLesson($this);
        }

        return $this;
    }

    public function removeTool(Tool $tool): self
    {
        if ($this->tool->contains($tool)) {
            $this->tool->removeElement($tool);
            // set the owning side to null (unless already changed)
            if ($tool->getLesson() === $this) {
                $tool->setLesson(null);
            }
        }

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

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(\DateTimeInterface $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getIllustration(): ?string
    {
        return $this->illustration;
    }

    public function setIllustration(?string $illustration): self
    {
        $this->illustration = $illustration;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Tool[]
     */
    public function getTool(): Collection
    {
        return $this->Tool;
    }
}
