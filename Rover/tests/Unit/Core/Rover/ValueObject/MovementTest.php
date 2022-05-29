<?php

namespace App\Tests\Unit\Core\Rover\ValueObject;

use PHPUnit\Framework\TestCase;
use App\Core\Rover\ValueObject\Movement;

final class MovementTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function test_init_movement_from_command(string $movement, string $expectedMovement): void
    {
        $movement = Movement::fromCommandInput($movement);

        $this->assertEquals($expectedMovement, $movement->getMovement());
    }

    public function provider(): array
    {
        return [
            "valid case" => [
                'LMLMLMLMM',
                'LMLMLMLMM',
            ],
            "should ignore bad input" => [
                'M23Me^MLLRe3RMMRM!RRM',
                'MMMLLRRMMRMRRM',
            ],
        ];
    }
}