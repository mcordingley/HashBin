<?php

namespace mcordingley\HashBinTests\Hashers;

use mcordingley\HashBin\Hashers\IntegerInterpreters\Unpack;
use mcordingley\HashBin\Hashers\Sip24;
use PHPUnit\Framework\TestCase;

final class Sip24Test extends TestCase
{
    public function testHash()
    {
        if (!function_exists('sodium_crypto_shorthash')) {
            static::markTestSkipped('Must have PHP 7.2+ or ext-sodium installed.');
        }

        $hasher = new Sip24('1234567890123456', new Unpack);

        static::assertTrue(is_int($hasher->hash('test')));
    }

    public function testBadKey()
    {
        static::expectException(\InvalidArgumentException::class);

        new Sip24('123', new Unpack);
    }
}
