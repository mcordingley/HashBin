<?php

namespace mcordingley\HashBin\Hashers;

use mcordingley\HashBin\Hasher;

final class CRC32 implements Hasher
{
    public function hash(string $input): int
    {
        return crc32($input);
    }
}
