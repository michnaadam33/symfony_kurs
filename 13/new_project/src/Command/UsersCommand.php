<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UsersCommand extends Command implements LoggerAwareInterface
{
    protected static $defaultName = 'app:users';

    use LoggerAwareTrait;

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }
    protected function configure()
    {
        $this
            ->setDescription('Lista osób')
            ->addArgument('maxRandom', InputArgument::REQUIRED, 'Maksymalna liczba losowa')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->logger->debug("Command run");
        $io = new SymfonyStyle($input, $output);
        $maxRandom = $input->getArgument('maxRandom');

        $random = rand(1, intval($maxRandom));
        $io->writeln([
            '<error>Twoja szczęśliwa liczba to: '.$random.'</error>',
            '<info>Gratulacje</info>'
        ]);

        if ('tak' === $io->choice("Wylistować osoby?", ['tak', 'nie'])){
            $io->writeln('Listowanie');
            $users = $this->entityManager->getRepository(User::class)->findAll();
            foreach ($users as $user){
                $io->text($user->getName());
            }
        }

        $io->success('Udało się');
    }
}
