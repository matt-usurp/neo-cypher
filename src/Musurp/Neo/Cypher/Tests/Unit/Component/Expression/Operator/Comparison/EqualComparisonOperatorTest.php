<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Tests\Unit\Component\Expression\Operator\Comparison;

use Musurp\Neo\Cypher\Component\Expression\Input\DirectUserInput;
use Musurp\Neo\Cypher\Component\Expression\Operator\Comparison\EqualComparisonOperator;

use PHPUnit\Framework\TestCase;

/**
 * {@inheritdoc}
 */
class EqualComparisonOperatorTest extends TestCase
{
    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Operator\Comparison\EqualComparisonOperator
     */
    public function createBasicEqualOperator(): void
    {
        $operator = new EqualComparisonOperator(
            new DirectUserInput(true),
            new DirectUserInput(false)
        );

        $cypher = <<<CYPHER
(TRUE = FALSE)
CYPHER;

        self::assertEquals($cypher, $operator->toString());
    }
}
