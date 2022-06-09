<?php

namespace App\Command;

use App\Repository\Auth\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GetUserCommand extends Command
{
    protected static $defaultName = 'app:get-user';
    protected static $defaultDescription = 'Add a short description for your command';

    public function __construct(EntityManagerInterface $manager, UserRepository $repo)
    {
        parent::__construct();
        $this->manager = $manager;
        $this->repo = $repo;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        //dd( $this->repo->findAll());
        dd( $this->repo->findOneBy(['email'=>'programozok@akh.hu']));


        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
