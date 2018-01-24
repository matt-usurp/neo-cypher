<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Component\Expression\Operator;

use Musurp\Neo\Cypher\AbstractComponent;
use Musurp\Neo\Cypher\Component\AbstractExpressionComponent;

/**
 * A logical operator abstraction.
 *
 * This abstraction states that any amount of components can be strung together in to a
 * single logical operation.
 */
abstract class AbstractLogicalOperator extends AbstractExpressionComponent
{
    private $components;

    /**
     * Return the operator.
     *
     * @return string
     */
    abstract protected function getOperator(): string;

    /**
     * Constructor.
     *
     * @param AbstractComponent[] $components
     */
    public function __construct(AbstractComponent ...$components)
    {
        $this->components = $components;
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        $glue = sprintf(' %s ', $this->getOperator());

        return sprintf('(%s)', implode($glue, $this->components));
    }
}
