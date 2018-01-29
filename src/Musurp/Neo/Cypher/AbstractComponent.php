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
     * @param bool $pretty
     *
     * @return string
     */
    abstract public function compile(bool $pretty = true): string;

    /**
     * A magic method to allow all components to be cast to string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->compile();
    }

    /**
     * Pad a string to be indented on every line.
     *
     * @param string $statement
     *
     * @return string
     */
    protected function pad(string $statement): string
    {
        return sprintf('  %s', str_replace("\n", "\n  ", $statement));
    }

    /**
     * Glue a series of components.
     *
     * @param string $glue
     * @param AbstractComponent[] $components
     * @param bool $pretty
     *
     * @return string
     */
    protected function glue(string $glue, array $components, bool $pretty = true): string
    {
        $compiled = [];

        foreach ($components as $component) {
            $compiled[] = $component->compile($pretty);
        }

        return implode($glue, $compiled);
    }
}
