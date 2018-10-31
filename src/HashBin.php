<?php

namespace mcordingley\HashBin;

use mcordingley\HashBin\BinStrategies\Multiply;
use mcordingley\HashBin\Hashers\CRC32;

final class HashBin
{
    private $base = '';
    private $binStrategy;
    private $hasher;

    public function __construct(Hasher $hasher, BinStrategy $binStrategy)
    {
        $this->hasher = $hasher;
        $this->binStrategy = $binStrategy;
    }

    public static function make(): self
    {
        return new static(new CRC32, new Multiply);
    }

    /**
     * Sets a base value to mix in with later values so that two HashBin instances with the same configuration can still
     * return different values.
     *
     * @param string $base
     * @return HashBin
     */
    public function setBase(string $base): self
    {
        $this->base = $base;

        return $this;
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
        return $this->binStrategy->bin($this->hasher->hash($this->base . $seed), $min, $max);
    }
}
