<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Component\Expression\Operator;

use Musurp\Neo\Cypher\Component\AbstractExpressionComponent;
use Musurp\Neo\Cypher\Component\Expression\AbstractIdentifierExpression;
use Musurp\Neo\Cypher\Component\Expression\Identifier\ScalarIdentifier;

/**
 * A comparison operator abstraction.
 *
 * This abstraction states that a component on the left will be compared with something
 * on the right using a comparison operator.
 */
abstract class AbstractComparisonOperator extends AbstractExpressionComponent
{
    private $left;
    private $right;

    /**
     * Return the operator.
     *
     * @return string
     */
    abstract protected function getOperator(): string;

    /**
     * Constructor.
     *
     * @param AbstractIdentifierExpression|bool|float|int|string|null $left
     * @param AbstractIdentifierExpression|bool|float|int|string|null $right
     */
    public function __construct($left, $right)
    {
        if (!$left instanceof AbstractIdentifierExpression) {
            $left = new ScalarIdentifier($left);
        }

        if (!$right instanceof AbstractIdentifierExpression) {
            $right = new ScalarIdentifier($right);
        }

        $this->left = $left;
        $this->right = $right;
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        return sprintf('(%s %s %s)', $this->left->toString(), $this->getOperator(), $this->right->toString());
    }
}
