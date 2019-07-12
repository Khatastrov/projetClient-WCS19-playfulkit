<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TutorialRepository")
 * @Vich\Uploadable()
 */
class Tutorial
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $date_creation;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="tutorial_image", fileNameProperty="illustration")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $illustration;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished = 0;

    /**
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\TutorialStep",
     *     mappedBy="tutorial",
     *     cascade={"persist", "remove"},
     *     orphanRemoval=true)
     */
    private $steps;

    /**
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\Tool",
     *     mappedBy="tutorials",
     *     cascade={"persist", "remove"})
     */
    private $tools;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="tutorials")
     * @ORM\JoinColumn(nullable=true)
     */
    private $author;


    public function __construct()
    {
        $this->steps = new ArrayCollection();
        $this->tools = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

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

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * @return Collection|TutorialStep[]
     */
    public function getSteps(): Collection
    {
        return $this->steps;
    }

    public function addStep(TutorialStep $step): self
    {
        if (!$this->steps->contains($step)) {
            $this->steps[] = $step;
            $step->setTutorial($this);
        }

        return $this;
    }

    public function removeStep(TutorialStep $step): self
    {
        if ($this->steps->contains($step)) {
            $this->steps->removeElement($step);
            // set the owning side to null (unless already changed)
            if ($step->getTutorial() === $this) {
                $step->setTutorial(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tool[]
     */
    public function getTools(): Collection
    {
        return $this->tools;
    }

    public function addTool(Tool $tool): self
    {
        if (!$this->tools->contains($tool)) {
            $this->tools[] = $tool;
            $tool->setTutorials($this);
        }

        return $this;
    }

    public function removeTool(Tool $tool): self
    {
        if ($this->tools->contains($tool)) {
            $this->tools->removeElement($tool);
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile() : ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     * @return $this
     * @throws \Exception
     */
    public function setImageFile(?File $imageFile = null)
    {
        $this->imageFile = $imageFile;

        if ($this->imageFile instanceof UploadedFile) {
            $this->date_creation = new \DateTime('now');
        }
        return $this;
    }
}
