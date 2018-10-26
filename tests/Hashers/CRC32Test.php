<?php

namespace mcordingley\HashBinTests\Hashers;

use mcordingley\HashBin\Hashers\CRC32;
use PHPUnit\Framework\TestCase;

final class Sha256Test extends TestCase
{
    public function testHash()
    {
        $hasher = new CRC32;

        static::assertTrue(is_int($hasher->hash('test')));
    }
}
