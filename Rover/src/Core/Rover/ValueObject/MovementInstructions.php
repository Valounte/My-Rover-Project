<?php

namespace App\Core\Rover\ValueObject;

final class MovementInstructions
{
    const RIGHT = "R";

    const LEFT = "L";
    
    const MOVE = "M";

    public function __construct(
        private string $movement
    ) {
    }

    public static function fromCommandInput(string $movement): self
    {
        $finalMovement = '';

        for ($i = 0; $i < strlen($movement); $i++) {
            if (
                $movement[$i] != ' ' &&
                in_array($movement[$i], [self::RIGHT, self::LEFT, self::MOVE])
            ) {
                $finalMovement .= $movement[$i];
            }
        } 

        return new self($finalMovement);
    }

    public function getMovement(): string
    {
        return $this->movement;
    }
}