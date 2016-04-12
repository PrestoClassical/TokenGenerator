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
interface TokenGeneratorInterface
{
    /** @const DEFAULT_STRENGTH The lowest default strength a non secure token length can be set to */
    const DEFAULT_STRENGTH = 16;

    /**
     * @param array                  $data
     * @param DateTimeImmutable|null $expiresOn
     * @param string                 $algorithm
     *
     * @return ExpiringToken
     */
    public function tokenWithExpiry(
        array             $data,
        DateTimeImmutable $expiresOn = null,
        string            $algorithm = 'sha256'
    ):ExpiringToken;

    /**
     * @param int $strength   | Default: 16
     *
     * @return Token
     */
    public function token(int $strength = 16):Token;
}
