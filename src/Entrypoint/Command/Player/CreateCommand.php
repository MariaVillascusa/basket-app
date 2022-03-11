<?php
declare(strict_types=1);

namespace App\Entrypoint\Command\Player;

use App\Application\Command\Player\Create\CreatePlayerCommand;
use App\Application\Command\Player\Create\CreatePlayerHandler;
use App\Domain\Model\Player\ValueObject\Rol\Rol;
use App\Domain\Service\Player\PlayerCreator;
use App\Infrastructure\Files\PlayerRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CreateCommand extends Command
{
    protected function configure()
    {
        $this->setName('create:player')
            ->setDescription('Create a player')
            ->setHelp('You can create a player with number, name, role and average')
            ->addArgument('playerNumber', InputArgument::REQUIRED, 'Pass the playerNumber.')
            ->addArgument('name', InputArgument::REQUIRED, 'Pass the name.')
            ->addArgument('role', InputArgument::REQUIRED, 'Pass the role.')
            ->addArgument('average', InputArgument::REQUIRED, 'Pass the average.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $playerNumber = $input->getArgument('playerNumber');
        $name = $input->getArgument('name');
        $role = $input->getArgument('role');
        $average = $input->getArgument('average');

        $command = CreatePlayerCommand::create((int)$playerNumber, $name, $role, (int)$average);

        $handler = new CreatePlayerHandler(new PlayerCreator(new PlayerRepository()));

        $handler->__invoke($command);

        $output->writeln(sprintf('JUGADOR CREADO' . PHP_EOL . 'num:%s - nombre:%s - rol:%s - med:%s/100',
            $playerNumber,
            $name,
            $role,
            $average
        ));
        return Command::SUCCESS;
    }
}