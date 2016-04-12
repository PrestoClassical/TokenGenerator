<?php
declare(strict_types=1);
/**
 * @see License
 */
namespace Signa;

use RuntimeException;

/**
 * @author Nigel Greenway <nigel.greenway@prestoclassical.co.uk>
 */
final class TokenGeneratorException extends RuntimeException
{
    /**
     * @param int $strength
     *
     * @return TokenGeneratorException
     */
    public static function strengthIsSetToLow(int $strength):self
    {
        return new self(
            sprintf(
                'The given strength is set at [%d]. Anything under 16 is considered insecure',
                $strength
            )
        );
    }

    /**
     * @param string $algorithm
     *
     * @return TokenGeneratorException
     */
    public static function invalidAlgorithmGiven(string $algorithm):self
    {
        return new self(
            sprintf(
                'The algorithm [%s] does not exist',
                $algorithm
            )
        );
    }

    /** @inheritdoc */
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
