<?php
declare(strict_types=1);

namespace App\Basket\Entrypoint\Command\Player;

use App\Basket\Application\Command\Player\Create\CreatePlayerCommand;
use App\Basket\Application\Command\Player\Create\CreatePlayerHandler;
use App\Basket\Domain\Service\Player\PlayerCreator;
use App\Basket\Infrastructure\Files\PlayerRepository;
use App\Domain\Model\Player\ValueObject\Rol\Rol;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CreateCommand extends Command
{
    protected function configure()
    {
        $this->setName('create')
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