<?php

namespace mcordingley\HashBin\BinStrategies;

use mcordingley\HashBin\BinStrategy;

/**
 * Uses the modulo operation to constrain the passed code to the desired range. This will make lower numbers more likely
 * to be output than higher ones, but the effect should be small given a large potential input range.
 */
final class Modulo implements BinStrategy
{
    public function bin(int $code, int $min, int $max): int
    {
        if ($code < $min) {
            return $max - ($min - $code) % ($max - $min + 1);
        }

        return $min + ($code - $min) % ($max - $min + 1);
    }
}
