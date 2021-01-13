<?php

namespace App\Tests;

use App\Controller\UtilisateurController;
use App\Entity\Utilisateur;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class TestAuthentificationPage extends TestCase
{
    function testuniteAuthentificationPage()
    {
        $utilisateur = new Utilisateur();
        /*
        $utilisateur->setMail("test@gmail.com");
        $utilisateur->setMail("password");
        */
        $request = new Request();
        $testAuthentification = new UtilisateurController();
        $testAuthentification->loginAction($request);
    }
}