<?php

namespace mcordingley\HashBin\Hashers\IntegerInterpreters;

use mcordingley\HashBin\Hashers\IntegerInterpreter;

final class Unpack implements IntegerInterpreter
{
    public function interpret(string $string): int
    {
        return unpack(PHP_INT_SIZE >= 8 ? 'q' : 'l', $string)[1];
    }
}
