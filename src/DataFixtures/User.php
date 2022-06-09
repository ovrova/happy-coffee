<?php

namespace App\DataFixtures;

use App\Entity\Auth\User as UserModel;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class User extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new UserModel();

        
        $user->setName('admin');
        $user->setEmail('programozok@akh.hu');
        $user->setRoles(['USER_ROLE']);

        //$password = $this->hasher->hashPassword($user, 'pass_1234');
        $user->setPassword('$password');
        
        $manager->persist($user);       
        $manager->flush(); 
    }
}
