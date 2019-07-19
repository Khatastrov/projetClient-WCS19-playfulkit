<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends AbstractController
{
    /**
     * @Route("/map", name="map")
     */
    public function index()
    {
        return $this->redirect('http://www.makery.info/labs-map/');
        //return $this->render('map/show.html.twig');
    }
}
