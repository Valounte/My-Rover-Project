<?php

namespace App\Tests\Unit\Core\Rover\Service;

use App\Core\Rover\Rover;
use PHPUnit\Framework\TestCase;
use App\Core\Map\ValueObject\Map;
use App\Core\Rover\ValueObject\MovementInstructions;
use App\Core\Rover\Service\MoveRoverService;

final class MoveRoverServiceTest extends TestCase
{
    public function test_move_rover(): void
    {
        $map = new Map(5, 5);
        $rover = new Rover(1, 2, 'N');
        $movement = new MovementInstructions('LMLMLMLMM');
        $expectedRover = new Rover(1, 3, 'N');

        $moveRoverService = new MoveRoverService($map);

        $rover = $moveRoverService->moveRover($rover, $movement);

        $this->assertEquals($expectedRover, $rover);
    }
}