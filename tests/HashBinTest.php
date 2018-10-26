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
            $binner = $hashBin->binner($i);

            static::assertGreaterThanOrEqual(0, $binner->bin(10));
            static::assertLessThanOrEqual(10, $binner->bin(10));
        }
    }

    public function testBinnersCached()
    {
        $hashBin = HashBin::make();
        $binner = $hashBin->binner('test');

        static::assertEquals($binner, $hashBin->binner('test'));
    }
}
