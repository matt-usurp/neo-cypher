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
 * An abstract component representing syntax elements.
 */
abstract class AbstractComponent
{
    /**
     * Compile the expression to string.
     *
     * @return string
     */
    abstract public function compile(): string;

    /**
     * A magic method to allow all components to be cast to string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->compile();
    }
}
