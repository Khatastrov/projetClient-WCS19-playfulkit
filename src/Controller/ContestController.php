<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContestController extends AbstractController
{
    /**
     * @Route("/contest", name="contest
     */
    public function index()
    {
        return $this->render('contest/index');
    }
}
