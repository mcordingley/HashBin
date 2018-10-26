<?php

namespace mcordingley\HashBin;

/**
 * Constrains the passed code to the desired range.
 */
interface BinStrategy
{
    /**
     * @param int $code A signed integer drawn uniformly from a large range.
     * @param int $min Minimum value, inclusive.
     * @param int $max Maximum value, inclusive.
     * @return int
     */
    public function bin(int $code, int $min, int $max): int;
}
