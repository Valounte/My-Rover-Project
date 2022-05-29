<?php

namespace App\Tests\Functionnal\Core\Rover\Service;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

final class InitAndMoveRoverCommandTest extends KernelTestCase
{
    /**
     * @dataProvider provider
     */
    public function testMoveRover(
        string $mapHeightAndWidth,
        string $firstRoverPositionAndDirection,
        string $firstRoverMovement,
        string $secondRoverPositionAndDirection,
        string $secondRoverMovement,
        string $expectedOutput
    )
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('app:init-and-move-rover');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'map_height_and_width' => $mapHeightAndWidth,
            'first_rover_coordinates' => $firstRoverPositionAndDirection,
            'first_rover_moves' => $firstRoverMovement,
            'second_rover_coordinates' => $secondRoverPositionAndDirection,
            'second_rover_moves' => $secondRoverMovement,
        ]);

        $commandTester->assertCommandIsSuccessful();

        $output = $commandTester->getDisplay();

        $this->assertSame($expectedOutput, $output);
    }

    public function provider(): array
    {
        return [
            "valid case" => [
                '5 5',
                '1 2 N',
                'LMLMLMLMM',
                '3 3 E',
                'MMRMMRMRRM',
                '1 3 N' . PHP_EOL . '5 1 E' . PHP_EOL,
            ],
            "second valid case" => [
                '2 8',
                '1 1 N',
                'LMLMLLLLLMM',
                '3 6 E',
                'MMMLLRRMMRMRRM',
                '2 0 E' . PHP_EOL . '8 5 N' . PHP_EOL,
            ],
            "should ignore bad movement entry" => [
                '2 8',
                '1 1 N',
                'LMLMEOLLLL!LM32M',
                '3 6 E',
                'MMMeeeeLLRR3MMRM2RRM',
                '2 0 E' . PHP_EOL . '8 5 N' . PHP_EOL,
            ]
        ];
    }
}