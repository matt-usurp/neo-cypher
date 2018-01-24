<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Builder\Helper;

use Musurp\Neo\Cypher\AbstractComponent;
use Musurp\Neo\Cypher\Component\Expression\AbstractIdentifierExpression;
use Musurp\Neo\Cypher\Component\Expression\Operator\Comparison\EqualComparisonOperator;
use Musurp\Neo\Cypher\Component\Expression\Operator\Comparison\GreaterThanComparisonOperator;
use Musurp\Neo\Cypher\Component\Expression\Operator\Comparison\GreaterThanOrEqualComparisonOperator;
use Musurp\Neo\Cypher\Component\Expression\Operator\Comparison\LessThanComparisonOperator;
use Musurp\Neo\Cypher\Component\Expression\Operator\Comparison\LessThanOrEqualComparisonOperator;
use Musurp\Neo\Cypher\Component\Expression\Operator\Comparison\NotEqualComparisonOperator;
use Musurp\Neo\Cypher\Component\Expression\Operator\Logical\AndLogicalOperator;
use Musurp\Neo\Cypher\Component\Expression\Operator\Logical\OrLogicalOperator;

class ExpressionHelper
{
    /**
     * @param AbstractComponent[] $components
     *
     * @return AndLogicalOperator
     */
    public function andX(AbstractComponent ...$components): AndLogicalOperator
    {
        return new AndLogicalOperator(...$components);
    }

    /**
     * @param AbstractComponent[] $components
     *
     * @return OrLogicalOperator
     */
    public function orX(AbstractComponent ...$components): OrLogicalOperator
    {
        return new OrLogicalOperator(...$components);
    }

    /**
     * @param AbstractIdentifierExpression|bool|float|int|string|null $left
     * @param AbstractIdentifierExpression|bool|float|int|string|null $right
     *
     * @return EqualComparisonOperator
     */
    public function eq($left, $right): EqualComparisonOperator
    {
        return new EqualComparisonOperator($left, $right);
    }

    /**
     * @param AbstractIdentifierExpression|bool|float|int|string|null $left
     * @param AbstractIdentifierExpression|bool|float|int|string|null $right
     *
     * @return NotEqualComparisonOperator
     */
    public function neq($left, $right): NotEqualComparisonOperator
    {
        return new NotEqualComparisonOperator($left, $right);
    }

    /**
     * @param AbstractIdentifierExpression|bool|float|int|string|null $left
     * @param AbstractIdentifierExpression|bool|float|int|string|null $right
     *
     * @return GreaterThanComparisonOperator
     */
    public function gt($left, $right): GreaterThanComparisonOperator
    {
        return new GreaterThanComparisonOperator($left, $right);
    }

    /**
     * @param AbstractIdentifierExpression|bool|float|int|string|null $left
     * @param AbstractIdentifierExpression|bool|float|int|string|null $right
     *
     * @return GreaterThanOrEqualComparisonOperator
     */
    public function gte($left, $right): GreaterThanOrEqualComparisonOperator
    {
        return new GreaterThanOrEqualComparisonOperator($left, $right);
    }

    /**
     * @param AbstractIdentifierExpression|bool|float|int|string|null $left
     * @param AbstractIdentifierExpression|bool|float|int|string|null $right
     *
     * @return LessThanComparisonOperator
     */
    public function lt($left, $right): LessThanComparisonOperator
    {
        return new LessThanComparisonOperator($left, $right);
    }

    /**
     * @param AbstractIdentifierExpression|bool|float|int|string|null $left
     * @param AbstractIdentifierExpression|bool|float|int|string|null $right
     *
     * @return LessThanOrEqualComparisonOperator
     */
    public function lte($left, $right): LessThanOrEqualComparisonOperator
    {
        return new LessThanOrEqualComparisonOperator($left, $right);
    }
}
