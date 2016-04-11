<?php

namespace spec\Signa;

use DateTimeImmutable;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Signa\ {
    SecureToken,
    TokenExpiryInterface,
    TokenValueInterface
};


/**
 * @mixin \Signa\SecureToken
 *
 * @author Nigel Greenway <github@futurepixels.co.uk>
 */
class SecureTokenSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(
            hash_hmac('sha256', 'some-data', 'some-key'),
            DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2016-05-01 10:30:00')
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(SecureToken::class);
        $this->shouldHaveType(TokenValueInterface::class);
        $this->shouldHaveType(TokenExpiryInterface::class);
    }

    public function it_should_show_a_value()
    {
        $this->value()->shouldBeString();
    }

    public function it_should_be_an_instance_of_DateTimeImmutable()
    {
        $this->expiresOn()->shouldHaveType(DateTimeImmutable::class);
    }
}
