<?php
declare(strict_types=1);

namespace App\Entrypoint\Command\Player;

use App\Application\Player\Create\CreatePlayerCommand;
use App\Application\Player\Create\CreatePlayerHandler;
use App\Domain\Model\Player\ValueObject\Rol\Rol;
use App\Domain\Service\Player\PlayerCreator;
use App\Infrastructure\Files\PlayerRepository;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

final class CreateCommand extends Command
{
    protected function configure()
    {
        $this->setName('create')
            ->setDescription('Create a player')
            ->setHelp('You can create a player with number, name, rol and average')
            ->addArgument('playerNumber', InputArgument::REQUIRED, 'Pass the playerNumber.')
            ->addArgument('name', InputArgument::REQUIRED, 'Pass the name.')
            ->addArgument('rol', InputArgument::REQUIRED, 'Pass the rol.')
            ->addArgument('average', InputArgument::REQUIRED, 'Pass the average.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $playerNumber = $input->getArgument('playerNumber');
        $name = $input->getArgument('name');
        $rol = Rol::getRolName($input->getArgument('rol'));

        $average = $input->getArgument('average');

        $command = CreatePlayerCommand::create((int)$playerNumber, $name, $rol, (int)$average);

        $handler = new CreatePlayerHandler(new PlayerCreator(new PlayerRepository()));

        $handler->__invoke($command);

        $output->writeln(sprintf('Creado: jugador %s - %s', $input->getArgument('playerNumber'), $input->getArgument('name')));
        return Command::SUCCESS;
    }
}