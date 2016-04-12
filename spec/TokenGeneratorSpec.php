<?php

namespace spec\Signa;

use DateTimeImmutable;
use PhpSpec\ {
    ObjectBehavior,
    Argument };
use Signa\ {
    ExpiringToken,
    Token,
    TokenGeneratorException,
    TokenGeneratorInterface
};


/**
 * @mixin \Signa\TokenGenerator
 *
 * @author Nigel Greenway <github@futurepixels.co.uk>
 */
class TokenGeneratorSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('s0m3-k3y');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(TokenGeneratorInterface::class);
    }

    public function it_should_throw_a_TokenGeneratorException_for_a_strength_value_lower_than_16()
    {
        $this->shouldThrow(TokenGeneratorException::class)->duringToken(15);
    }

    public function it_should_throw_a_TokenGeneratorException_for_an_invalid_alogorithm()
    {
        $this->shouldThrow(TokenGeneratorException::class)->duringTokenWithExpiry(
            ['user' => 'Lang Lang', 'age' => 32], new DateTimeImmutable('+30 days'), 'invalidAlgo'
        );
    }

    public function it_should_return_a_non_secure_token()
    {
        $this->token(28)->shouldHaveType(Token::class);
    }

    public function it_should_generate_a_secure_token_with_an_expiry_date()
    {
        $this->tokenWithExpiry(['user' => 'Lang Lang', 'age' => 32], new DateTimeImmutable('+30 days'))->shouldHaveType(ExpiringToken::class);
    }

    public function it_should_generate_a_secure_token_with_no_expiry_date_set()
    {
        $this->tokenWithExpiry(['user' => 'Lang Lang', 'age' => 32])->shouldHaveType(ExpiringToken::class);
    }
}
