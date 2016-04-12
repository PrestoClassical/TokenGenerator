<?php

namespace spec\Signa;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Signa\ {
    Token,
    TokenValueInterface
};


/**
 * @mixin \Signa\Token
 *
 * @author Nigel Greenway <github@futurepixels.co.uk>
 */
class TokenSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('s0m4s1xt33nstrln');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Token::class);
        $this->shouldHaveType(TokenValueInterface::class);
    }

    public function it_should_have_the_correct_value()
    {
        $this->value()->shouldEqual('s0m4s1xt33nstrln');
    }
}
