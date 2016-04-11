<?php
declare(strict_types=1);
/**
 * @see License
 */
namespace Signa;

use DateTimeImmutable;

/**
 * @author Nigel Greenway <github@futurepixels.co.uk>
 */
interface TokenExpiryInterface
{
    /** @return DateTimeImmutable */
    public function expiresOn() :DateTimeImmutable;
}
