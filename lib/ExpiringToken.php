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
class ExpiringToken implements TokenValueInterface, TokenExpiryInterface
{
    /** @var  string            $value */
    private $value;
    /** @var  DateTimeImmutable $expiresOn */
    private $expiresOn;

    /**
     * @param string            $value
     * @param DateTimeImmutable $expiresOn
     */
    public function __construct(
        string            $value,
        DateTimeImmutable $expiresOn = null
    ) {
        $this->value     = $value;
        $this->expiresOn = $expiresOn;
    }

    /** @inheritdoc */
    public function value() :string
    {
        return $this->value;
    }

    /** @inheritdoc */
    public function expiresOn() :DateTimeImmutable
    {
        return $this->expiresOn;
    }
}
