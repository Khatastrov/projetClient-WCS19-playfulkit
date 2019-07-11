<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CGUController
 * @package App\Controller
 */
class EducController extends AbstractController
{
    /**
     * @Route("/Educ", name="educ")
     */
    public function educ()
    {
        return $this->render('Educ/educ.html.twig');
    }
}
