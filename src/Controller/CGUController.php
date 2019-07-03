<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CGUController
 * @package App\Controller
 */
class CGUController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/CGU", name="cgu")
     */
    public function cgu()
    {
        return $this->render('CGU/cgu.html.twig');
    }
}