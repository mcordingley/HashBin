<?php

namespace mcordingley\HashBin;

interface Hasher
{
    /**
     * @param string $input
     * @return int A signed integer between PHP_INT_MIN and PHP_INT_MAX
     */
    public function hash(string $input): int;
}
