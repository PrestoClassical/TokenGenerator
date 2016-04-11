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
class TokenGenerator implements TokenGeneratorInterface
{
    /** @var string                 $securityKey */
    private $securityKey;

    /**
     * @param string $securityKey
     */
    public function __construct(string $securityKey)
    {
        $this->securityKey = $securityKey;
    }

    /** @inheritdoc */
    public function secureToken(
        array             $data,
        DateTimeImmutable $expiresOn = null,
        string            $algorithm = 'sha256'
    ):SecureToken {
        $this->validateAlgorithm($algorithm);

        return new SecureToken(
            $this->generateSecureTokenValue($data, $expiresOn, $algorithm),
            $expiresOn
        );
    }

    /** @inheritdoc */
    public function token(
        int $strength = 16
    ):Token {
        $this->checkStrength($strength);
        $strength = (int) $strength/2;
        $tokenValue = $this->generateTokenValue($strength);

        return new Token($tokenValue);
    }

    /**
     * @param int $strength
     *
     * @throws TokenGeneratorException
     *
     * @return void
     */
    private function checkStrength(int $strength)
    {
        if ($strength < 16) {
            throw TokenGeneratorException::strengthIsSetToLow($strength);
        }
    }

    /**
     * @param string $algorithm
     *
     * @throws TokenGeneratorException
     *
     * @return void
     */
    public function validateAlgorithm(string $algorithm)
    {
        if (in_array($algorithm, hash_algos(), true) === false) {
            throw TokenGeneratorException::invalidAlgorithmGiven($algorithm);
        }
    }

    /**
     * @param int $strength
     *
     * @return string
     */
    private function generateTokenValue(int $strength) :string
    {
        return bin2hex(
            random_bytes($strength)
        );
    }

    /**
     * @param array                  $data
     * @param DateTimeImmutable|null $expiresOn
     * @param string                 $algorithm
     *
     * @return string           A string generated with `hash_hmac`
     */
    private function generateSecureTokenValue(
        array             $data,
        DateTimeImmutable $expiresOn = null,
        string            $algorithm
    ):string {

        if ($expiresOn instanceof DateTimeImmutable) {
            $dataString = implode('.', $data);
            $string     = sprintf(
                '%s.%s',
                $dataString,
                $expiresOn->format('Y-m-d H:i:s')
            );

            return hash_hmac(
                $algorithm,
                $string,
                $this->securityKey
            );
        }

        $string = implode('.', $data);

        return hash_hmac(
            $algorithm,
            $string,
            $this->securityKey
        );
    }
}
