<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PrixController extends AbstractController
{
    /**
     * @Route("/prix", name="prix")
     */
    public function index()
    {
        return $this->render('prix/index.html.twig', [
            'controller_name' => 'PrixController',
        ]);
    }
}
