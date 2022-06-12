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
        $user->setEmail('admin@admin.hu');
        $user->setRoles(['ROLE_ADMIN','ROLE_USER']);

        $password = $this->hasher->hashPassword($user, 'admin');
        $user->setPassword($password);
        
        $manager->persist($user);       
        $manager->flush(); 
    }
}
