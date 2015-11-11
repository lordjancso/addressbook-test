<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setEmail('admin@example.com');
        $userAdmin->setRole('ROLE_ADMIN');
        $userAdmin->setPassword('$2y$13$vPQEmxB3KYGO.gvw3pNxlOVfGoqps8wm9gcjmgmK7hdDHNFl.r5Ry'); //admin
        $userAdmin->setUsername('admin');

        $manager->persist($userAdmin);
        $manager->flush();
    }
}
