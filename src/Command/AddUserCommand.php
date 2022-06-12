<?php

namespace App\Command;

use App\Entity\Auth\User; 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AddUserCommand extends Command
{
    protected static $defaultName = 'app:add-user';
    protected static $defaultDescription = 'Add user command';

    public function __construct(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->passwordHasher = $passwordHasher;    
        $this->manager = $entityManager;
    }

   

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
  

        $helper = $this->getHelper('question');

        $question = new Question('Email: ', 'email');
        $email = $helper->ask($input, $output, $question);

        $question = new Question('Name: ', 'name');
        $name = $helper->ask($input, $output, $question);

        $question = new Question('Password: ', 'password');
        $plainPassword = $helper->ask($input, $output, $question);

    

        $user = new User();
 
        // See https://symfony.com/doc/5.4/security.html#registering-the-user-hashing-passwords
        $hashedPassword = $this->passwordHasher->hashPassword($user, $plainPassword);

        $user->setPassword($hashedPassword);
        $user->setEmail($email);
        $user->setName($name);
        $user->setRoles(['ROLE_USER']);
        
        $this->manager->persist($user);
        $this->manager->flush();
        

        $io->success('Yess!!');

        return Command::SUCCESS;
    }
}
