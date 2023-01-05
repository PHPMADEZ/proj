<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Console\Question\Question;
use App\Entity\User;
use Symfony\Component\Validator\Validator\ValidatorInterface;



// the name of the command is what users type after "php bin/console"
#[AsCommand(name: 'app:create-user')]
class CreateUserCommand extends Command
{
    public function __construct(private readonly EntityManagerInterface $entityManager, private readonly UserPasswordHasherInterface $passwordHasher, private readonly ValidatorInterface $validator)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Creates a new user.');
        $this->addArgument('email');
        $this->addArgument('password');
    }

    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        
       
        //ask for input if not provided
        if (!$input->getArgument('email')) {
            $email = $this->getHelper('question')->ask($input, $output, new Question('Please choose a email:'));
            $input->setArgument('email', $email);
        }
        if (!$input->getArgument('password')) {
            $password = $this->getHelper('question')->ask($input, $output, new Question('Please choose a password:'));
            $input->setArgument('password', $password);
        }
        
        //if provided
        $user = new User();
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');
        $user->setEmail($email);
        $user->setPassword($this->passwordHasher->hashPassword($user, $password));

        $errors = $this->validator->validate($user);

        if (count($errors) > 0) {
            $output->writeln((string) $errors);
            return Command::FAILURE;
        }
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $output->writeln('User created!');
        return Command::SUCCESS;


    }

}