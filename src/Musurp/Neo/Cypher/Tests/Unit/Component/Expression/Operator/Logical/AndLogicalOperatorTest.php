<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Tests\Unit\Component\Expression\Operator\Logical;

use Musurp\Neo\Cypher\Component\Expression\Input\DirectUserInput;
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
            new DirectUserInput(true),
            new DirectUserInput(false)
        );

        $cypher = <<<CYPHER
(TRUE AND FALSE)
CYPHER;

        self::assertEquals($cypher, $operator->toString());
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
            new DirectUserInput(true),
            new AndLogicalOperator(
                new DirectUserInput(true),
                new DirectUserInput('hello')
            )
        );

        $cypher = <<<CYPHER
(TRUE AND (TRUE AND 'hello'))
CYPHER;

        self::assertEquals($cypher, $operator->toString());
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
                    new DirectUserInput(true),
                    new DirectUserInput('foo')
                ),
                new DirectUserInput('bar')
            ),
            new AndLogicalOperator(
                new DirectUserInput(false),
                new AndLogicalOperator(
                    new DirectUserInput(4),
                    new DirectUserInput(7.4)
                )
            )
        );

        $cypher = <<<CYPHER
(((TRUE AND 'foo') AND 'bar') AND (FALSE AND (4 AND 7.4)))
CYPHER;

        self::assertEquals($cypher, $operator->toString());
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
                    new DirectUserInput(true),
                    new DirectUserInput('foo')
                ),
                new DirectUserInput('bar')
            ),
            new AndLogicalOperator(
                new DirectUserInput(false),
                new AndLogicalOperator(
                    new DirectUserInput(4),
                    new DirectUserInput(7.4)
                ),
                new DirectUserInput(false)
            ),
            new AndLogicalOperator(
                new DirectUserInput(2),
                new DirectUserInput('hammer')
            )
        );

        $cypher = <<<CYPHER
(((TRUE AND 'foo') AND 'bar') AND (FALSE AND (4 AND 7.4) AND FALSE) AND (2 AND 'hammer'))
CYPHER;

        self::assertEquals($cypher, $operator->toString());
    }
}
