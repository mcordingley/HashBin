<?php

namespace mcordingley\HashBin\BinStrategies;

use mcordingley\HashBin\BinStrategy;

final class Multiply implements BinStrategy
{
    private $coefficient;

    public function __construct($coefficient = 0.61803398874989)
    {
        $this->coefficient = $coefficient;
    }

    public function bin(int $code, int $min, int $max): int
    {
        $product = $this->coefficient * $code;
        $fractional = $product - floor($product);

        return floor($fractional * ($max - $min + 1)) + $min;
    }
}
