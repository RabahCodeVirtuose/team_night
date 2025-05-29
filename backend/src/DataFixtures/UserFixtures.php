<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        $user1 = new Users();
        $user1->setEmail("rabahtoubal14@gmail.com");
        $user1->setRoles(["ROLE_ADMIN"]);
        $user1->setNom("TOUBAL");
        $user1->setPrenom("Rabah");
        $user1->setTelephone("07 65 65 52 03");
        $user1->setIsVerified(true);
        $user1->setType("admin");
        $hashedpassword = $this->hasher->hashPassword($user1, "%Rabahtoubalamga4520032003");
        $user1->setPassword($hashedpassword);
        $manager->persist($user1);


        $user3 = new Users();
        $user3->setEmail("jules.martin@example.com");
        $user3->setRoles(["ROLE_USER"]);
        $user3->setNom("Martin");
        $user3->setPrenom("Jules");
        $user3->setTelephone("06 59 27 93 88");
        $user3->setIsVerified(true);
        $user3->setType("client");
        $hashedpassword1 = $this->hasher->hashPassword($user1, "ming2003");
        $user3->setPassword($hashedpassword1);
        $manager->persist($user3);




        $manager->flush();
    }
}
