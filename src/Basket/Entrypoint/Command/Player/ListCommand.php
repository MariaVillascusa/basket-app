<?php

namespace App\Basket\Entrypoint\Command\Player;

use App\Basket\Application\Command\Player\GetPlayersList\GetPlayersListCommand;
use App\Basket\Application\Command\Player\GetPlayersList\GetPlayersListHandler;
use App\Basket\Domain\Service\Player\PlayerList;
use App\Basket\Domain\Service\Player\PlayerOrder;
use App\Basket\Infrastructure\Files\PlayerRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ListCommand extends Command
{
    protected function configure()
    {
        $this->setName('list')
            ->setDescription('Get the players list')
            ->setHelp('You can obtain the list with all players and their data')
            ->addOption('order', 'o', InputOption::VALUE_OPTIONAL, 'Order list columns', false);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filter = $input->getOption('order');

        $command = GetPlayersListCommand::create();

        $handler = new GetPlayersListHandler(new PlayerList(new PlayerRepository()), new PlayerOrder());

        $players = $handler($command, $filter);

        $output->writeln('Número' . "\t" . 'Nombre' . "\t" . 'Posición' . "\t" . 'Media');
        $output->writeln($players);

        return Command::SUCCESS;
    }
}