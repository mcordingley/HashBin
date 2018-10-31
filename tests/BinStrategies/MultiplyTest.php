<?php

namespace mcordingley\HashBinTests\BinStrategies;

use mcordingley\HashBin\BinStrategies\Multiply;
use PHPUnit\Framework\TestCase;

final class MultiplyTest extends TestCase
{
    public function testBin()
    {
        $binStrategy = new Multiply;

        for ($i = -1000; $i < 1000; $i++) {
            $bin = $binStrategy->bin($i, -10, 15);

            static::assertGreaterThanOrEqual(-10, $bin);
            static::assertLessThanOrEqual(15, $bin);
        }
    }
}
