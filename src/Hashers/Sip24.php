<?php

namespace mcordingley\HashBin\Hashers;

use mcordingley\HashBin\Hasher;

final class Sip24 implements Hasher
{
    private $interpreter;
    private $key;

    public function __construct(string $key, IntegerInterpreter $interpreter)
    {
        if (strlen($key) !== SODIUM_CRYPTO_SHORTHASH_KEYBYTES) {
            throw new \InvalidArgumentException(
                '$key must be ' . SODIUM_CRYPTO_SHORTHASH_KEYBYTES .
                ' bytes in length, but is ' .
                strlen($key) . ' bytes.'
            );
        }

        $this->interpreter = $interpreter;
        $this->key = $key;
    }

    public function hash(string $input): int
    {
        return $this->interpreter->interpret(sodium_crypto_shorthash($input, $this->key));
    }
}
