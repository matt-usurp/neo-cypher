<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Component\Expression\Operator\Logical;

use Musurp\Neo\Cypher\AbstractComponent;

/**
 * Implementation for logical operator: NOT.
 */
final class NotLogicalOperator extends AbstractComponent
{
    private $expression;

    /**
     * Constructor.
     *
     * @param AbstractComponent $expression
     */
    public function __construct(AbstractComponent $expression)
    {
        $this->expression = $expression;
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        return sprintf('NOT %s', $this->expression->toString());
    }
}
