<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CGUController
 * @package App\Controller
 */
class AboutUsController extends AbstractController
{
    /**
     * @Route("/AboutUs", name="AboutUs")
     */
    public function AboutUs()
    {
        return $this->render('AboutUs/AboutUs.html.twig');
    }
}