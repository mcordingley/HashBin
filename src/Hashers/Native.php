<?php

namespace mcordingley\HashBin\Hashers;

use mcordingley\HashBin\Hasher;

final class Native implements Hasher
{
    private $algorithm;
    private $interpreter;

    /**
     * @param string $algorithm An algorithm per the `\hash` function.
     * @param IntegerInterpreter $interpreter
     */
    public function __construct(string $algorithm, IntegerInterpreter $interpreter)
    {
        $this->algorithm = $algorithm;
        $this->interpreter = $interpreter;
    }

    public function hash(string $input): int
    {
        return $this->interpreter->interpret(hash($this->algorithm, $input, true));
    }
}
