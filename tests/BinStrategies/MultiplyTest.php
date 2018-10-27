<?php

namespace mcordingley\HashBinTests\BinStrategies;

use mcordingley\HashBin\BinStrategies\Multiply;
use PHPUnit\Framework\TestCase;

final class MultiplyTest extends TestCase
{
    public function testBin()
    {
        $binStrategy = new Multiply;

        for ($i = 0; $i < 1000; $i++) {
            static::assertGreaterThanOrEqual(-10, $binStrategy->bin($i, -10, 15));
            static::assertLessThanOrEqual(15, $binStrategy->bin($i, -10, 15));
        }
    }
}
