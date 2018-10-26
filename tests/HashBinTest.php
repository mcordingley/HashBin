<?php

namespace mcordingley\HashBinTests;

use mcordingley\HashBin\HashBin;
use PHPUnit\Framework\TestCase;

final class HashBinTest extends TestCase
{
    public function testHashBin()
    {
        $hashBin = HashBin::make();

        for ($i = 0; $i < 1000; $i++) {
            static::assertGreaterThanOrEqual(0, $hashBin->bin($i, 10));
            static::assertLessThanOrEqual(10, $hashBin->bin($i, 10));
        }
    }
}
