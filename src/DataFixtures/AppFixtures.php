<?php

use App\Entity\Auth\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    // ...
    public function load(ObjectManager $manager) :void
    {
 
        $user = new User();

        
        $user->setName('admin');

        $password = $this->hasher->hashPassword($user, 'pass_1234');
        $user->setPassword($password);
        
        $manager->persist($user);       
        $manager->flush();

    }
}