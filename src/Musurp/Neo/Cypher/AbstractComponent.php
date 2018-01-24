<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher;

/**
 * An abstract query component.
 *
 * This class represents a base for anything in the Cypher syntax tree.
 */
abstract class AbstractComponent
{
    /**
     * Return the expression as string.
     *
     * @return string
     */
    abstract public function toString(): string;

    /**
     * Allow magic return of the expression as string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
    }
}
