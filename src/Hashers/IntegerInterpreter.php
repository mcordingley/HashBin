<?php

namespace mcordingley\HashBin\Hashers;

interface IntegerInterpreter
{
    /**
     * @param string $string Raw binary string
     * @return int
     */
    public function interpret(string $string): int;
}
