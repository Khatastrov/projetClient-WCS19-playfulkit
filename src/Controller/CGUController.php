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
     * @Route("/CGU", name="cgu")
     */
    public function cgu()
    {
        return $this->render('CGU/cgu.html.twig');
    }
}