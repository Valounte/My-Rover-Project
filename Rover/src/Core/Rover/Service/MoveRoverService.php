<?php

namespace App\Core\Rover\Service;

use App\Core\Rover\Rover;
use App\Core\Map\ValueObject\Map;
use App\Core\Rover\ValueObject\MovementInstructions;

final class MoveRoverService
{
    private int $xPosition;

    private int $yPosition;

    private string $roverDirection;

    const NORTH = 'N';

    const EAST = 'E';

    const SOUTH = 'S';

    const WEST = 'W';

    public function __construct(
        private Map $map,
    ) {
    }

    public function moveRover(Rover $rover, MovementInstructions $movement): Rover
    {
        $movement = $movement->getMovement();
        $this->xPosition = $rover->getX();
        $this->yPosition = $rover->getY();
        $this->roverDirection = $rover->getDirection();

        for ($i = 0; $i < strlen($movement); $i++) {
            match ($movement[$i]) {
                MovementInstructions::RIGHT => $this->turnRight(),
                MovementInstructions::LEFT => $this->turnLeft(),
                MovementInstructions::MOVE => $this->move(),
            };
        }

        $rover->setX($this->xPosition);
        $rover->setY($this->yPosition);
        $rover->setDirection($this->roverDirection);

        return $rover;
    }

    private function move(): void
    {
       match($this->roverDirection) {
            self::NORTH => $this->moveNorth(),
            self::EAST => $this->moveEast(),
            self::SOUTH => $this->moveSouth(),
            self::WEST => $this->moveWest()
        };
    }

    private function moveNorth(): void
    {
        if ($this->yPosition < $this->map->getHeight()) {
            $this->yPosition++;
        }
    }

    private function moveEast(): void
    {
        if ($this->xPosition < $this->map->getWidth()) {
            $this->xPosition++;
        }
    }

    private function moveSouth(): void
    {
        if ($this->yPosition > 0) {
            $this->yPosition--;
        }
    }

    private function moveWest(): void
    {
        if ($this->xPosition > 0) {
            $this->xPosition--;
        }
    }

    private function turnLeft(): void
    {
        match($this->roverDirection) {
            self::NORTH => $this->roverDirection = self::WEST,
            self::EAST => $this->roverDirection = self::NORTH,
            self::SOUTH => $this->roverDirection = self::EAST,
            self::WEST => $this->roverDirection = self::SOUTH
        };
    }

    private function turnRight(): void
    {
        match($this->roverDirection) {
            self::NORTH => $this->roverDirection = self::EAST,
            self::EAST => $this->roverDirection = self::SOUTH,
            self::SOUTH => $this->roverDirection = self::WEST,
            self::WEST => $this->roverDirection = self::NORTH
        };
    }
}
