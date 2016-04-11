<?php
declare(strict_types=1);
/**
 * @see License
 */
namespace Signa;

/**
 * @author Nigel Greenway <github@futurepixels.co.uk>
 */
class Token implements TokenValueInterface
{
    /** @var string $value */
    private $value;

    /** @param string $value */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /** @inheritdoc */
    public function value() :string
    {
        return $this->value;
    }
}
