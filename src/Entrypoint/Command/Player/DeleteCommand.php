<?php
declare(strict_types=1);

namespace App\Entrypoint\Command\Player;

use App\Application\Command\Player\Delete\DeletePlayerCommand;
use App\Application\Command\Player\Delete\DeletePlayerHandler;
use App\Domain\Service\Player\PlayerDestroyer;
use App\Infrastructure\Files\PlayerRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class DeleteCommand extends Command
{
    protected function configure()
    {
        $this->setName('delete:player')
            ->setDescription('Delete a player')
            ->setHelp('You can delete a player')
            ->addArgument('playerNumber', InputArgument::REQUIRED, 'Pass the playerNumber.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $playerNumber = $input->getArgument('playerNumber');

        $command = DeletePlayerCommand::create((int)$playerNumber);

        $handler = new DeletePlayerHandler(new PlayerDestroyer(new PlayerRepository()));

        $handler->__invoke($command);

        $output->writeln(sprintf('Borrado jugador %s',
            $playerNumber,
        ));
        return Command::SUCCESS;
    }
}