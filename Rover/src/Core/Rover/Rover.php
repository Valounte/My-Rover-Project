<?php

namespace App\Core\Rover;

class Rover
{
    public function __construct(
        private int $x,
        private int $y,
        private string $direction
    ) {
    }

    public static function fromCommandInput(string $roverPositionAndDirection): self
    {
        $roverPositionAndDirectionArray = explode(' ', $roverPositionAndDirection);
        $x = (int) $roverPositionAndDirectionArray[0];
        $y = (int) $roverPositionAndDirectionArray[1];
        $direction = $roverPositionAndDirectionArray[2];

        return new self($x, $y, $direction);
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }

    public function setX(int $x): void
    {
        $this->x = $x;
    }

    public function setY(int $y): void
    {
        $this->y = $y;
    }

    public function setDirection(string $direction): void
    {
        $this->direction = $direction;
    }
}