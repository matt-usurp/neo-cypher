<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Helper;

use Musurp\Neo\Cypher\AbstractComponent;
use Musurp\Neo\Cypher\Component\Expression\AbstractEvaluateableExpression;
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
    public function andX(AbstractComponent ...$components): AndLogicalOperator
    {
        return new AndLogicalOperator(...$components);
    }

    public function orX(AbstractComponent ...$components): OrLogicalOperator
    {
        return new OrLogicalOperator(...$components);
    }

    public function eq(
        AbstractEvaluateableExpression $left,
        AbstractEvaluateableExpression $right
    ): EqualComparisonOperator {
        return new EqualComparisonOperator($left, $right);
    }

    public function neq(
        AbstractEvaluateableExpression $left,
        AbstractEvaluateableExpression $right
    ): NotEqualComparisonOperator {
        return new NotEqualComparisonOperator($left, $right);
    }

    public function gt(
        AbstractEvaluateableExpression $left,
        AbstractEvaluateableExpression $right
    ): GreaterThanComparisonOperator {
        return new GreaterThanComparisonOperator($left, $right);
    }

    public function gte(
        AbstractEvaluateableExpression $left,
        AbstractEvaluateableExpression $right
    ): GreaterThanOrEqualComparisonOperator {
        return new GreaterThanOrEqualComparisonOperator($left, $right);
    }

    public function lt(
        AbstractEvaluateableExpression $left,
        AbstractEvaluateableExpression $right
    ): LessThanComparisonOperator {
        return new LessThanComparisonOperator($left, $right);
    }

    public function lte(
        AbstractEvaluateableExpression $left,
        AbstractEvaluateableExpression $right
    ): LessThanOrEqualComparisonOperator {
        return new LessThanOrEqualComparisonOperator($left, $right);
    }
}
