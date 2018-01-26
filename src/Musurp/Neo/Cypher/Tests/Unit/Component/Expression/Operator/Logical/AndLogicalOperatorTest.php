<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Tests\Unit\Component\Expression\Operator\Logical;

use Musurp\Neo\Cypher\Component\Expression\Identifier\ScalarIdentifier;
use Musurp\Neo\Cypher\Component\Expression\Operator\Logical\AndLogicalOperator;

use PHPUnit\Framework\TestCase;

/**
 * {@inheritdoc}
 */
class AndLogicalOperatorTest extends TestCase
{
    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Operator\Logical\AndLogicalOperator
     */
    public function createBasicAndOperator(): void
    {
        $operator = new AndLogicalOperator(
            new ScalarIdentifier(true),
            new ScalarIdentifier(false)
        );

        $cypher = <<<CYPHER
(
  TRUE
  AND FALSE
)
CYPHER;

        self::assertEquals($cypher, $operator->compile());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Operator\Logical\AndLogicalOperator
     */
    public function createNestedAndOperators(): void
    {
        $operator = new AndLogicalOperator(
            new ScalarIdentifier(true),
            new AndLogicalOperator(
                new ScalarIdentifier(true),
                new ScalarIdentifier('hello')
            )
        );

        $cypher = <<<CYPHER
(
  TRUE
  AND (
    TRUE
    AND 'hello'
  )
)
CYPHER;

        self::assertEquals($cypher, $operator->compile());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Operator\Logical\AndLogicalOperator
     */
    public function createComplexNestedAndOperators(): void
    {
        $operator = new AndLogicalOperator(
            new AndLogicalOperator(
                new AndLogicalOperator(
                    new ScalarIdentifier(true),
                    new ScalarIdentifier('foo')
                ),
                new ScalarIdentifier('bar')
            ),
            new AndLogicalOperator(
                new ScalarIdentifier(false),
                new AndLogicalOperator(
                    new ScalarIdentifier(4),
                    new ScalarIdentifier(7.4)
                )
            )
        );

        $cypher = <<<CYPHER
(
  (
    (
      TRUE
      AND 'foo'
    )
    AND 'bar'
  )
  AND (
    FALSE
    AND (
      4
      AND 7.4
    )
  )
)
CYPHER;

        self::assertEquals($cypher, $operator->compile());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Operator\Logical\AndLogicalOperator
     */
    public function createComplexNestedAndOperatorsUsingArgumentUnpacking(): void
    {
        $operator = new AndLogicalOperator(
            new AndLogicalOperator(
                new AndLogicalOperator(
                    new ScalarIdentifier(true),
                    new ScalarIdentifier('foo')
                ),
                new ScalarIdentifier('bar')
            ),
            new AndLogicalOperator(
                new ScalarIdentifier(false),
                new AndLogicalOperator(
                    new ScalarIdentifier(4),
                    new ScalarIdentifier(7.4)
                ),
                new ScalarIdentifier(false)
            ),
            new AndLogicalOperator(
                new ScalarIdentifier(2),
                new ScalarIdentifier('hammer')
            )
        );

        $cypher = <<<CYPHER
(
  (
    (
      TRUE
      AND 'foo'
    )
    AND 'bar'
  )
  AND (
    FALSE
    AND (
      4
      AND 7.4
    )
    AND FALSE
  )
  AND (
    2
    AND 'hammer'
  )
)
CYPHER;

        self::assertEquals($cypher, $operator->compile());
    }
}
