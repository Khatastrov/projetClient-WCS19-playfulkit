<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TutorialRepository")
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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="tutorials")
     * @ORM\JoinColumn(nullable=true)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $illustration;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TutorialStep", mappedBy="tutorial", orphanRemoval=true)
     */
    private $steps;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Software", inversedBy="tutorials")
     */
    private $softwares;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Handtool", inversedBy="tutorials")
     */
    private $handtools;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Hardware", inversedBy="tutorials")
     */
    private $hardwares;

    public function __construct()
    {
        $this->steps = new ArrayCollection();
        $this->softwares = new ArrayCollection();
        $this->handtools = new ArrayCollection();
        $this->hardwares = new ArrayCollection();
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
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

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
     * @return Collection|Software[]
     */
    public function getSoftwares(): Collection
    {
        return $this->softwares;
    }

    public function addSoftware(Software $software): self
    {
        if (!$this->softwares->contains($software)) {
            $this->softwares[] = $software;
        }

        return $this;
    }

    public function removeSoftware(Software $software): self
    {
        if ($this->softwares->contains($software)) {
            $this->softwares->removeElement($software);
        }

        return $this;
    }

    /**
     * @return Collection|Handtool[]
     */
    public function getHandtools(): Collection
    {
        return $this->handtools;
    }

    public function addHandtool(Handtool $handtool): self
    {
        if (!$this->handtools->contains($handtool)) {
            $this->handtools[] = $handtool;
        }

        return $this;
    }

    public function removeHandtool(Handtool $handtool): self
    {
        if ($this->handtools->contains($handtool)) {
            $this->handtools->removeElement($handtool);
        }

        return $this;
    }

    /**
     * @return Collection|Hardware[]
     */
    public function getHardwares(): Collection
    {
        return $this->hardwares;
    }

    public function addHardware(Hardware $hardware): self
    {
        if (!$this->hardwares->contains($hardware)) {
            $this->hardwares[] = $hardware;
        }

        return $this;
    }

    public function removeHardware(Hardware $hardware): self
    {
        if ($this->hardwares->contains($hardware)) {
            $this->hardwares->removeElement($hardware);
        }

        return $this;
    }
}
