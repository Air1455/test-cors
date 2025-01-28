<?php

namespace App\Command;

use App\Service\UserManager; // Assurez-vous que ce service existe
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:create-user',
    description: 'Crée un nouvel utilisateur.',
)]
class CreateUserCommand extends Command
{
    private UserManager $userManager;

    public function __construct(UserManager $userManager)
    {
        parent::__construct();
        $this->userManager = $userManager;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('username', InputArgument::REQUIRED, 'Le nom d\'utilisateur de l\'utilisateur.')
            ->addArgument('password', InputArgument::REQUIRED, 'Le mot de passe de l\'utilisateur.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $username = $input->getArgument('username');
        $password = $input->getArgument('password');

        // Appel à la méthode pour créer l'utilisateur
        $this->userManager->create($username, $password);

        $output->writeln('Utilisateur créé avec succès : ' . $username);

        return Command::SUCCESS;
    }
}