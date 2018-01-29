<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Component\Expression\Identifier;

use Musurp\Neo\Cypher\Component\Expression\AbstractIdentifierExpression;

/**
 * {@inheritdoc}
 */
class ScalarIdentifier extends AbstractIdentifierExpression
{
    private $value;

    /**
     * Constructor.
     *
     * @param bool|float|int|string $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Return the expression as string.
     *
     * @param bool $pretty
     *
     * @return string
     */
    public function compile(bool $pretty = true): string
    {
        if (is_null($this->value)) {
            return 'NULL';
        }

        if (is_bool($this->value)) {
            return $this->value
                ? 'TRUE'
                : 'FALSE';
        }

        if (is_string($this->value)) {
            return sprintf('\'%s\'', $this->value);
        }

        return (string) $this->value;
    }
}
