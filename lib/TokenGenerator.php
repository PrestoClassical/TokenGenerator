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
    /** @var  integer|null  $remainder */
    private $remainder;

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
        $strength = $this->strengthHandler($strength);
        $tokenValue = $this->generateTokenValue($strength);

        return new Token($tokenValue);
    }

    /**
     * @param int $strength
     *
     * @return int
     */
    private function strengthHandler(int $strength):int
    {
        $this->checkStrength($strength);

        $this->remainder = $strength%2;
        $divisible = ($strength-$this->remainder) / 2;

        return $divisible+$this->remainder;
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
        if ($this->remainder === null) {
            return bin2hex(
                random_bytes($strength)
            );
        }

        $value = bin2hex(
            random_bytes($strength)
        );

        return substr($value, 0, -1);
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
