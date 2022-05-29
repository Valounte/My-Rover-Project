<?php

namespace App\Core\Map\ValueObject;

final class Map
{
    public function __construct(
        private int $height, 
        private int $width
    ) {
    }

    public static function fromCommandInput(string $mapHeightAndWidth): self
    {
        $mapHeightAndWidthArray = explode(' ', $mapHeightAndWidth);
        $mapHeight = (int) $mapHeightAndWidthArray[0];
        $mapWidth = (int) $mapHeightAndWidthArray[1];

        return new self($mapHeight, $mapWidth);
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getWidth(): int
    {
        return $this->width;
    }
}