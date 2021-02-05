<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/", name="test")
     */
    public function index(): Response
    {
        return $this->render('acceuil.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    /**
     * @Route("/apropos", name="test2")
     */
    public function index2(): Response
    {
        return $this->render('apropos.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    /**
     * @Route("/talent", name="test3")
     */
    public function index3(): Response
    {
        return $this->render('rechercheprofile.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    /**
     * @Route("/modifierprofil", name="test4")
     */
    public function index4(): Response
    {
        return $this->render('modifieprofile.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    /**
     * @Route("/test", name="test5")
     */
    public function index5(): Response
    {
        return $this->render('test.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
