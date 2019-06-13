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
     * @ORM\ManyToOne(targetEntity="Tool", inversedBy="tutorials")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tool;

    /**
     * @ORM\ManyToOne(targetEntity="Tutorial", inversedBy="tools")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tutorial;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    public function getTool()
    {
        return $this->tool;
    }

    public function setTool($tool)
    {
        $this->tool = $tool;
    }

    public function getTutorial()
    {
        return $this->tutorial;
    }

    public function setTutorial($tutorial)
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
