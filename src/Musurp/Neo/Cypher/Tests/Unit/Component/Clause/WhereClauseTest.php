<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Tests\Unit\Component\Clause;

use Musurp\Neo\Cypher\Component\Clause\WhereClause;
use Musurp\Neo\Cypher\Component\Expression\Identifier\ScalarIdentifier;
use Musurp\Neo\Cypher\Component\Expression\Operator\Comparison\GreaterThanOrEqualComparisonOperator;
use Musurp\Neo\Cypher\Component\Expression\Operator\Logical\AndLogicalOperator;
use Musurp\Neo\Cypher\Component\Expression\Operator\Logical\NotLogicalOperator;
use Musurp\Neo\Cypher\Component\Path;
use Musurp\Neo\Cypher\Component\Path\Node;

use PHPUnit\Framework\TestCase;

/**
 * {@inheritdoc}
 */
class WhereClauseTest extends TestCase
{
    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Clause\WhereClause
     */
    public function createClauseEmptyThrows(): void
    {
        self::markTestIncomplete();

        $clause = new WhereClause([]);
        $clause->compile();
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Clause\WhereClause
     */
    public function createClauseWithExpression(): void
    {
        $clause = new WhereClause();
        $clause->where(new ScalarIdentifier(true));

        $cypher = <<<CYPHER
WHERE TRUE
CYPHER;

        self::assertEquals($cypher, $clause->compile());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Clause\WhereClause
     */
    public function createClauseWithMoreComplexExpression(): void
    {
        $clause = new WhereClause();
        $clause->where(
            new AndLogicalOperator(
                new GreaterThanOrEqualComparisonOperator(
                    new ScalarIdentifier(1),
                    new ScalarIdentifier(0)
                ),
                new NotLogicalOperator(
                    (new Path(new Node('var', ['LABEL'], [])))
                        ->relatesTo(
                            new Node(null, ['TWO'], [])
                        )
                )
            )
        );

        $cypher = <<<CYPHER
WHERE (
  (1 >= 0)
  AND NOT (var:LABEL)-->(:TWO)
)
CYPHER;

        self::assertEquals($cypher, $clause->compile());
    }
}
