<?php


namespace App\Entity;

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
     * @ORM\ManyToOne(targetEntity="Tool", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(nullable=false, name="tool_id", referencedColumnName="id")
     */
    private $tool;

    /**
     * @ORM\ManyToOne(targetEntity="Tutorial", inversedBy="tools", cascade={"persist", "remove"}, fetch="LAZY")
     * @ORM\JoinColumn(nullable=false, name="tutorial_id", referencedColumnName="id")
     */
    private $tutorial;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    public function getId()
    {
        return $this->id;
    }

    public function getTool()
    {
        return $this->tool;
    }

    public function setTool(Tool $tool)
    {
        $this->tool = $tool;
    }

    public function getTutorial()
    {
        return $this->tutorial;
    }

    public function setTutorial(Tutorial $tutorial)
    {
        $this->tutorial = $tutorial;
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
