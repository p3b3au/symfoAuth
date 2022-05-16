<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\User;
use App\Entity\Interfaces\IRoles;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements IRoles
{
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername("admin@admin.fr");
        $user->addRoles(self::ROLE_ADMIN);
        $user->setPassword($this->userPasswordHasher->hashPassword(
            $user,
            "Tibo2612"
        ));
        
        $manager->persist($user);

        $user = new User();
        $user->setUsername("bib@admin.fr");
        $user->setPassword($this->userPasswordHasher->hashPassword(
            $user,
            "didi"
        ));

        $manager->persist($user);


        $manager->flush();
    }
}
