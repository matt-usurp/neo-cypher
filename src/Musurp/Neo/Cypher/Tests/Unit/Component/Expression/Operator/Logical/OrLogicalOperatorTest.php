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
use Musurp\Neo\Cypher\Component\Expression\Operator\Logical\OrLogicalOperator;

use PHPUnit\Framework\TestCase;

/**
 * {@inheritdoc}
 */
class OrLogicalOperatorTest extends TestCase
{
    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Operator\Logical\OrLogicalOperator
     */
    public function createBasicOrOperator(): void
    {
        $operator = new OrLogicalOperator(
            new ScalarIdentifier(true),
            new ScalarIdentifier(false)
        );

        $cypher = <<<CYPHER
(TRUE OR FALSE)
CYPHER;

        self::assertEquals($cypher, $operator->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Operator\Logical\OrLogicalOperator
     */
    public function createNestedOrOperators(): void
    {
        $operator = new OrLogicalOperator(
            new ScalarIdentifier(true),
            new OrLogicalOperator(
                new ScalarIdentifier(true),
                new ScalarIdentifier('hello')
            )
        );

        $cypher = <<<CYPHER
(TRUE OR (TRUE OR 'hello'))
CYPHER;

        self::assertEquals($cypher, $operator->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Operator\Logical\OrLogicalOperator
     */
    public function createComplexNestedOrOperators(): void
    {
        $operator = new OrLogicalOperator(
            new OrLogicalOperator(
                new OrLogicalOperator(
                    new ScalarIdentifier(true),
                    new ScalarIdentifier('foo')
                ),
                new ScalarIdentifier('bar')
            ),
            new OrLogicalOperator(
                new ScalarIdentifier(false),
                new OrLogicalOperator(
                    new ScalarIdentifier(4),
                    new ScalarIdentifier(7.4)
                )
            )
        );

        $cypher = <<<CYPHER
(((TRUE OR 'foo') OR 'bar') OR (FALSE OR (4 OR 7.4)))
CYPHER;

        self::assertEquals($cypher, $operator->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Operator\Logical\OrLogicalOperator
     */
    public function createComplexNestedOrOperatorsUsingArgumentUnpacking(): void
    {
        $operator = new OrLogicalOperator(
            new OrLogicalOperator(
                new OrLogicalOperator(
                    new ScalarIdentifier(true),
                    new ScalarIdentifier('foo')
                ),
                new ScalarIdentifier('bar')
            ),
            new OrLogicalOperator(
                new ScalarIdentifier(false),
                new OrLogicalOperator(
                    new ScalarIdentifier(4),
                    new ScalarIdentifier(7.4)
                ),
                new ScalarIdentifier(false)
            ),
            new OrLogicalOperator(
                new ScalarIdentifier(2),
                new ScalarIdentifier('hammer')
            )
        );

        $cypher = <<<CYPHER
(((TRUE OR 'foo') OR 'bar') OR (FALSE OR (4 OR 7.4) OR FALSE) OR (2 OR 'hammer'))
CYPHER;

        self::assertEquals($cypher, $operator->toString());
    }
}
