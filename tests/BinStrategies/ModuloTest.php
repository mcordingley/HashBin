<?php

namespace mcordingley\HashBinTests\BinStrategies;

use mcordingley\HashBin\BinStrategies\Modulo;
use PHPUnit\Framework\TestCase;

final class ModuloTest extends TestCase
{
    public function testBin()
    {
        $binStrategy = new Modulo;

        static::assertEquals(0, $binStrategy->bin(0, 0, 59));
        static::assertEquals(59, $binStrategy->bin(59, 0, 59));
        static::assertEquals(0, $binStrategy->bin(60, 0, 59));

        static::assertEquals(49, $binStrategy->bin(-20, -10, 59));
        static::assertEquals(-10, $binStrategy->bin(-10, -10, 59));
        static::assertEquals(0, $binStrategy->bin(0, -10, 59));
        static::assertEquals(59, $binStrategy->bin(59, -10, 59));
        static::assertEquals(-10, $binStrategy->bin(60, -10, 59));
    }
}
