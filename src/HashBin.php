<?php

namespace mcordingley\HashBin;

use mcordingley\HashBin\BinStrategies\Modulo;
use mcordingley\HashBin\Hashers\CRC32;

final class HashBin
{
    private $binStrategy;
    private $hasher;

    public function __construct(Hasher $hasher, BinStrategy $binStrategy)
    {
        $this->hasher = $hasher;
        $this->binStrategy = $binStrategy;
    }

    public static function make(): self
    {
        return new static(new CRC32, new Modulo);
    }

    /**
     * Calculates a consistent bin between zero and $max, inclusive.
     *
     * @param string seed
     * @param int $max
     * @return int
     */
    public function bin(string $seed, int $max): int
    {
        return $this->binRange($seed, 0, $max);
    }

    /**
     * Calculates a consistent bin between $min and $max, inclusive.
     *
     * @param string seed
     * @param int $min
     * @param int $max
     * @return int
     */
    public function binRange(string $seed, int $min, int $max): int
    {
        return $this->binStrategy->bin($this->hasher->hash($seed), $min, $max);
    }
}
