# Signa

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

## Install

Via Composer

``` bash
$ composer require nigelgreenway/signa
```

## Usage

```php
<?php

require __DIR__.'/vendor/autoload.php';

$tokenGenerator = new \Signa\TokenGenerator('s0m3-s3cur3-k3y');

$secureToken = $tokenGenerator->secureToken(
    [
        'user_name' => 'Scooby Doo',
        'age'       => 7,
    ],
    new \DateTimeImmutable('+30 Days'),
    'sha256'
);

// A secure token, for password resets and such
echo "A secure token\n";
echo sprintf("Value: %s\n", $secureToken->value()); // Some hash string
echo sprintf("Expires on: %s\n", $secureToken->expiresOn()->format('Y-m-d H:i:s')); // 30 days from today, aka the future

// An insecure token, generally CSRF and such
echo "\nAn insecure token\n";
$insecureToken = $tokenGenerator->token(36);
echo sprintf("Value: %s (Length %d)\n", $insecureToken->value(), strlen($insecureToken->value())); // Some string, 36 char length

echo "\nAn insecure token with odd value\n";
$insecureToken = $tokenGenerator->token(33);
echo sprintf("Value: %s (Length: %d)\n", $insecureToken->value(), strlen($insecureToken->value())); // Some string, 33 char length

```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email github@futurepixels.co.uk instead of using the issue tracker.

## Credits

- [Nigel Greenway][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/nigelgreenway/signa.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/nigelgreenway/signa/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/nigelgreenway/signa.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/nigelgreenway/signa.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/nigelgreenway/signa.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/nigelgreenway/signa
[link-travis]: https://travis-ci.org/nigelgreenway/signa
[link-scrutinizer]: https://scrutinizer-ci.com/g/nigelgreenway/signa/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/nigelgreenway/signa
[link-downloads]: https://packagist.org/packages/nigelgreenway/signa
[link-author]: https://github.com/nigelgreenway
[link-contributors]: ../../contributors
