<?php

namespace App\UI\Command;

use App\Core\Rover\Rover;
use App\Core\Map\ValueObject\Map;
use App\Core\Rover\ValueObject\MovementInstructions;
use App\Core\Rover\Service\MoveRoverService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:init-and-move-rover',
    description: 'Initialize map/rover and move the rover'
)]
class InitAndMoveRoverCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addArgument('map_height_and_width', InputArgument::REQUIRED, 'Plz enter map height and width')
            ->addArgument('first_rover_coordinates', InputArgument::REQUIRED, 'Plz enter first rover coordinates')
            ->addArgument('first_rover_moves', InputArgument::REQUIRED, 'Plz enter first rover moves')
            ->addArgument('second_rover_coordinates', InputArgument::REQUIRED, 'Plz enter second rover coordinates')
            ->addArgument('second_rover_moves', InputArgument::REQUIRED, 'Plz enter second rover moves')
        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $map = Map::fromCommandInput($input->getArgument('map_height_and_width'));

        $firstRover = Rover::fromCommandInput($input->getArgument('first_rover_coordinates'));
        $firstRoverMovement = MovementInstructions::fromCommandInput($input->getArgument('first_rover_moves'));

        $secondRover = Rover::fromCommandInput($input->getArgument('second_rover_coordinates'));
        $secondRoverMovement = MovementInstructions::fromCommandInput($input->getArgument('second_rover_moves'));

        $moveRoverService = new MoveRoverService($map);

        $firstRover = $moveRoverService->moveRover($firstRover, $firstRoverMovement);
        $secondRover = $moveRoverService->moveRover($secondRover, $secondRoverMovement);

        $output->writeln($firstRover->getX() . ' ' . $firstRover->getY() . ' ' . $firstRover->getDirection());
        $output->writeln($secondRover->getX() . ' ' . $secondRover->getY() . ' ' . $secondRover->getDirection());

        return Command::SUCCESS;
    }


}