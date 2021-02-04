<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("", name="test")
     */
    public function index(): Response
    {
        return $this->render('acceuil.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
