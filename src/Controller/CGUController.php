<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CGUController
 * @package App\Controller
 * @Route("/CGU", name="condition_")
 */
class CGUController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="utilisation_generale")
     */
    public function cgu()
    {
        return $this->render('CGU/cgu.html.twig');
    }
}