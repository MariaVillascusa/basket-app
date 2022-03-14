<?php

namespace App\Entrypoint\Command\Player;

use App\Application\Command\Player\GetPlayersList\GetPlayersListCommand;
use App\Application\Command\Player\GetPlayersList\GetPlayersListHandler;
use App\Domain\Service\Player\PlayerList;
use App\Infrastructure\Files\PlayerRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;

class ListCommand extends Command
{
    protected function configure()
    {
        $this->setName('list:player')
            ->setDescription('Get the players list')
            ->setHelp('You can obtain the list with all players and their data')
            ->addOption('order', 'o', InputOption::VALUE_OPTIONAL, 'Order list columns', false);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $order = $input->getOption('order');

        $command = GetPlayersListCommand::create();

        $handler = new GetPlayersListHandler(new PlayerList(new PlayerRepository()));

        $players = $handler($command);
        $players = $handler->orderBy($players, $order);

        $output->writeln('Número' . "\t" . 'Nombre' . "\t" . 'Posición' . "\t" . 'Media');
        $output->writeln($players);

        return Command::SUCCESS;
    }
}