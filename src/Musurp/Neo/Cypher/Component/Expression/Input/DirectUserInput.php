<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Component\Expression\Input;

use Musurp\Neo\Cypher\Component\Expression\AbstractEvaluateableExpression;

/**
 * {@inheritdoc}
 */
class DirectUserInput extends AbstractEvaluateableExpression
{
    private $value;

    /**
     * Constructor.
     *
     * @param bool|int|string $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Return the expression as string.
     *
     * @return string
     */
    public function toString(): string
    {
        $value = $this->value;

        if (is_bool($this->value)) {
            $value = $this->value
                ? 'TRUE'
                : 'FALSE';
        }

        if (is_string($this->value)) {
            $value = sprintf('\'%s\'', $this->value);
        }

        return (string) $value;
    }
}
