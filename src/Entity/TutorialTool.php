<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tutorial_tool")
 */
class TutorialTool
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Tool", mappedBy="tutorials" ,cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tool;

    /**
     * @ORM\OneToMany(targetEntity="Tutorial", mappedBy="tools", cascade={"persist", "remove"}, fetch="LAZY")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tutorial;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    public function __construct()
    {
        $this->tool = new  ArrayCollection();
        $this->tutorial = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTool() : Collection
    {
        return $this->tool;
    }

    public function addTool(TutorialTool $tool): self
    {
        if (!$this->tool->contains($tool)) {
            $this->tool[] = $tool;
        }
        return $this;
    }

    public function removeTool(TutorialTool $tool): self
    {
        if ($this->tool->contains($tool)) {
            $this->tool->removeElement($tool);
        }
        return $this;
    }

    public function getTutorial() : Collection
    {
        return $this->tutorial;
    }

    public function addTutorial(TutorialTool $tutorial): self
    {
        if (!$this->tutorial->contains($tutorial)) {
            $this->tutorial[] = $tutorial;
            $tutorial->addTool($this);
        }
        return $this;
    }

    public function removeTutorial(TutorialTool $tutorial): self
    {
        if ($this->tutorial->contains($tutorial)) {
            $this->tutorial->removeElement($tutorial);
            $tutorial->removeTool($this);
        }
        return $this;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
}
