<?php

namespace mcordingley\HashBin;

final class Binner
{
    private $binStrategy;
    private $code;

    public function __construct(int $code, BinStrategy $binStrategy)
    {
        $this->binStrategy = $binStrategy;
        $this->code = $code;
    }

    /**
     * Calculates a consistent bin between zero and $max, inclusive.
     *
     * @param int $max
     * @return int
     */
    public function bin(int $max): int
    {
        return $this->binRange(0, $max);
    }

    /**
     * Calculates a consistent bin between $min and $max, inclusive.
     *
     * @param int $min
     * @param int $max
     * @return int
     */
    public function binRange(int $min, int $max): int
    {
        return $this->binStrategy->bin($this->code, $min, $max);
    }
}
