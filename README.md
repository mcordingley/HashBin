# HashBin

[![Build Status](https://api.travis-ci.org/repositories/mcordingley/HashBin.svg)](https://travis-ci.org/mcordingley/HashBin)
[![Code Climate](https://codeclimate.com/github/mcordingley/HashBin/badges/gpa.svg)](https://codeclimate.com/github/mcordingley/HashBin)
[![Code Climate](https://codeclimate.com/github/mcordingley/HashBin/badges/coverage.svg)](https://codeclimate.com/github/mcordingley/HashBin)

This library takes a string value and generates integer hash codes from it. Useful if you want to calculate a "random"
integer from some value that remains consistent across calls. PHP has access to a wealth of hashing functions, but their
outputs are nearly always strings. This wraps those hash functions and some additional logic into a simple
object-oriented interface.

```
use mcordingley\HashBin\BinStrategies\Modulo;
use mcordingley\HashBin\HashBin;
use mcordingley\HashBin\Hashers\IntegerInterpreters\Unpack;
use mcordingley\HashBin\Hashers\Sip24;

// Use library defaults.
$hashBin = HashBin::make();

// Or use other options.
$hashBin = new HashBin(new Sip24($key, new Unpack), new Modulo);

// From 0 to 15, inclusive.
$first = $hashBin->bin('test', 15);

// From 5 to 15, inclusive.
$second = $hashBin->binRange('test', 5, 15);
```