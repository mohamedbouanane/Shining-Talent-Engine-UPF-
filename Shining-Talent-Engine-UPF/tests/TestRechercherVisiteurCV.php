<?php

namespace App\Tests;

use App\Controller\CvController;
use App\Repository\CvRepository;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\TestCase;

class TestRechercherVisiteurCV extends TestCase
{
    function testuniteAuthentificationPage()
    {
         $cvRepository = new CvRepository(ManagerRegistry::class);
        $testAuthentification = new CvController();
        $testAuthentification->Recherche( $cvRepository);
    }
}