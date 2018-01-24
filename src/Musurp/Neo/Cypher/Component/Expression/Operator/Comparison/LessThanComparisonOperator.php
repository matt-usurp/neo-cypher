<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Component\Expression\Operator\Comparison;

use Musurp\Neo\Cypher\Component\Expression\Operator\AbstractComparisonOperator;

/**
 * {@inheritdoc}
 */
class LessThanComparisonOperator extends AbstractComparisonOperator
{
    /**
     * {@inheritdoc}
     */
    protected function getOperator(): string
    {
        return '<';
    }
}
