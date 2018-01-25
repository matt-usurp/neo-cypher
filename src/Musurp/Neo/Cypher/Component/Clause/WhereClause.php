<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Component\Clause;

use Musurp\Neo\Cypher\AbstractComponent;
use Musurp\Neo\Cypher\Component\AbstractExpressionComponent;

/**
 * Implementation for clause: WHERE.
 */
final class WhereClause extends AbstractComponent
{
    protected $expression;

    /**
     * Constructor.
     *
     * @param AbstractExpressionComponent|null $expression
     */
    public function __construct(AbstractExpressionComponent $expression = null)
    {
        $this->expression = $expression;
    }

    public function where(AbstractExpressionComponent $expression): self
    {
        $this->expression = $expression;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        return sprintf('WHERE %s', $this->expression->toString());
    }
}
