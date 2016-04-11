<?php
declare(strict_types=1);
/**
 * @see License
 */
namespace Signa;

/**
 * @author Nigel Greenway <github@futurepixels.co.uk>
 */
interface TokenValueInterface
{
    /** @return string */
    public function value() :string;
}
