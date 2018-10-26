<?php

namespace mcordingley\HashBin;

use mcordingley\HashBin\BinStrategies\Modulo;
use mcordingley\HashBin\Hashers\IntegerInterpreters\Unpack;
use mcordingley\HashBin\Hashers\Native;

final class HashBin
{
    private $binners = [];
    private $binStrategy;
    private $hasher;

    public function __construct(Hasher $hasher, BinStrategy $binStrategy)
    {
        $this->hasher = $hasher;
        $this->binStrategy = $binStrategy;
    }

    public static function make(): self
    {
        return new static(new Native('sha256', new Unpack), new Modulo);
    }

    public function binner(string $seed): Binner
    {
        if (!isset($this->binners[$seed])) {
            $this->binners[$seed] = new Binner($this->hasher->hash($seed), $this->binStrategy);
        }

        return $this->binners[$seed];
    }
}
