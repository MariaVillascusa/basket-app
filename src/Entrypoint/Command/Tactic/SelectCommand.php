<?php

namespace App\Entrypoint\Command\Tactic;

use App\Application\Command\Player\GetPlayersList\GetPlayersListCommand;
use App\Application\Command\Player\GetPlayersList\GetPlayersListHandler;
use App\Application\Command\Tactic\Select\SelectTacticCommand;
use App\Application\Command\Tactic\Select\SelectTacticHandler;
use App\Domain\Service\Player\PlayerList;
use App\Domain\Service\Player\PlayerOrder;
use App\Domain\Service\TacticCalculator;
use App\Infrastructure\Files\PlayerRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

class SelectCommand extends \Symfony\Component\Console\Command\Command
{
    protected function configure()
    {
        $this->setName('select:tactic')
            ->setDescription('Select the team tactic')
            ->setHelp('You can choose the team tactic with the best lineup');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            'Selecciona la táctica que quieres (defensa, defensa zonal o ataque)',
            ['Defensa', 'Defensa zonal', 'Ataque']
        );
        $question->setErrorMessage('Táctica %s no es válida.');
        $tactic = $helper->ask($input, $output, $question);

        $output->writeln(strtoupper($tactic));
        $output->writeln('Mejor alieación: ');

        $command = SelectTacticCommand::create();

        $handler = new SelectTacticHandler(new TacticCalculator(new PlayerRepository(), new PlayerOrder()));

        $players = $handler($command, $tactic);
        $output->writeln('Número' . "\t" . 'Nombre' . "\t" . 'Posición' . "\t" . 'Media');
        $output->writeln($players);

        return Command::SUCCESS;
    }
}