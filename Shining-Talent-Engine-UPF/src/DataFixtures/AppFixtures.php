<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
      for ($i = 0; $i < 20; $i++) {
          $user = new User();
          $user->setEmail('mohammed@hehe.com '.$i);
          $user->setRoles(ROLE_ADMIN);
          $user->setPassword('KEKW');
          $user->setPass('KEKW');
          $user->setNomComplet('mohammed sida');
          $user->setProfilePublic(true);
          $manager->persist($user);
      }

        $manager->flush();
    }
}
