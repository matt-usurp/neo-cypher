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
            new DirectUserInput(true),
            new DirectUserInput(false)
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
            new DirectUserInput(true),
            new OrLogicalOperator(
                new DirectUserInput(true),
                new DirectUserInput('hello')
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
                    new DirectUserInput(true),
                    new DirectUserInput('foo')
                ),
                new DirectUserInput('bar')
            ),
            new OrLogicalOperator(
                new DirectUserInput(false),
                new OrLogicalOperator(
                    new DirectUserInput(4),
                    new DirectUserInput(7.4)
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
                    new DirectUserInput(true),
                    new DirectUserInput('foo')
                ),
                new DirectUserInput('bar')
            ),
            new OrLogicalOperator(
                new DirectUserInput(false),
                new OrLogicalOperator(
                    new DirectUserInput(4),
                    new DirectUserInput(7.4)
                ),
                new DirectUserInput(false)
            ),
            new OrLogicalOperator(
                new DirectUserInput(2),
                new DirectUserInput('hammer')
            )
        );

        $cypher = <<<CYPHER
(((TRUE OR 'foo') OR 'bar') OR (FALSE OR (4 OR 7.4) OR FALSE) OR (2 OR 'hammer'))
CYPHER;

        self::assertEquals($cypher, $operator->toString());
    }
}
