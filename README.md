# HashBin

[![Build Status](https://api.travis-ci.org/repositories/mcordingley/HashBin.svg)](https://travis-ci.org/mcordingley/HashBin)
[![Code Climate](https://codeclimate.com/github/mcordingley/HashBin/badges/gpa.svg)](https://codeclimate.com/github/mcordingley/HashBin)
[![Code Climate](https://codeclimate.com/github/mcordingley/HashBin/badges/coverage.svg)](https://codeclimate.com/github/mcordingley/HashBin)

This library takes a string value and generates integer hash codes from it. Useful if you want to calculate a "random"
integer from some value that remains consistent across calls. PHP has access to a wealth of hashing functions, but their
outputs are nearly always strings. This wraps those hash functions and some additional logic into a simple
object-oriented interface.


## Installation

`composer require mcordingley/hash-bin`

## Quick Start

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

## API

Usage starts with the `HashBin` class. You can create a new instance either directly with the `new` operator or with the
`make` static factory method. `make` will give you a configuration chosen to work for the majority of use cases and
should be your go-to unless there is reason otherwise. The defaults may change in a future release and will not be
considered a breaking change, so if you depend on having the bin outputs not change between releases consider explicitly
setting your configuration through the constructor method.

In addition to the `bin` and `binRange` methods described above, `HashBin` comes with `setBase(string $base)` to set a
common base value to mix into later values. This is done so that different `HashBin` instances can provide different sets
of outputs.

The `HashBin` constructor takes two arguments, a `Hasher` and a `BinStrategy`. The `Hasher` is responsible for converting
supplied strings into integer values. `BinStrategy` then takes that integer and constrains it to the specified range.

### Integer Interpreters

Integer interpreters are used by some hashers to convert binary strings into integers. `Unpack` is the only supplied
interpreter and takes no arguments in its constructor.

### Hashers

`CRC32` is the default hasher implementation and uses the CRC32 hash function to directly convert strings to integers.
It is extremely fast, but provides no guarantees against collisions if given user-generated values. Its constructor takes
no arguments. This hasher should be your default choice.

If you require some cryptographic hardening against potential collisions, use `Sip24`. This hasher requires libsodium to
be present, either via PHP 7.2 or newer or through having the `sodium_compat` library installed. It uses SipHash-2-4 to
calculate its hashes. SipHash is a keyed hash function that works well with short inputs. Its constructor takes a secret
key `SODIUM_CRYPTO_SHORTHASH_KEYBYTES` long and an integer interpreter. The key should be a raw binary string that
persists between uses of this library. Ideally, the key should be generated with the `random_bytes` method:
`random_bytes(SODIUM_CRYPTO_SHORTHASH_KEYBYTES)`. Store the key encoded in hexadecimal (`bin2hex`) or base64 (`base64_encode`)
and be sure to decode it before use.

`Native` wraps the `hash` function in PHP and enables the use of any hash algorithm supported by that method. Since this
returns a string instead of an integer, it must also be supplied with an `IntegerInterpreter` to translate that binary
string into an integer, so the constructor signature is thus: `new Native('algo', new Unpack)`. Note that only enough
bits are used from the output to construct an integer, so even if the underlying hash function is collision resistant,
the bins that are output are not.

### Bin Strategies

Two bin strategies are provided with the library: `Multiply` and `Modulo`.

`Multiply` is the recommended implementation and is used in `HashBin::make()`. Its constructor takes a single, optional
argument. The default value is the recommended one and should be used unless there is specific reason otherwise. This
implementation provides good all-around characteristics.

`Modulo` uses the modulo arithmetic operator to constrain the integer range. It has the downside that it will slightly
overweight lower values in its range against higher values, but also provides somewhat more predictable output values
given its input.