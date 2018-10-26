<?php

namespace mcordingley\HashBinTests\Hashers;

use mcordingley\HashBin\Hashers\IntegerInterpreters\Unpack;
use mcordingley\HashBin\Hashers\Native;
use PHPUnit\Framework\TestCase;

final class NativeTest extends TestCase
{
    public function testHash()
    {
        $hasher = new Native('sha256', new Unpack);

        static::assertTrue(is_int($hasher->hash('test')));
    }
}
