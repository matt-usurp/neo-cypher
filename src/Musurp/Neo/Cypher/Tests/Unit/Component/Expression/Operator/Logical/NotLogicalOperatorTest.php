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
use Musurp\Neo\Cypher\Component\Expression\Operator\Logical\NotLogicalOperator;

use PHPUnit\Framework\TestCase;

/**
 * {@inheritdoc}
 */
class NotLogicalOperatorTest extends TestCase
{
    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Operator\Logical\NotLogicalOperator
     */
    public function createBasicNotOperator(): void
    {
        $operator = new NotLogicalOperator(
            new ScalarIdentifier(true)
        );

        $cypher = <<<CYPHER
NOT TRUE
CYPHER;

        self::assertEquals($cypher, $operator->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Operator\Logical\NotLogicalOperator
     */
    public function createNestedNotOperators(): void
    {
        $operator = new NotLogicalOperator(
            new NotLogicalOperator(
                new ScalarIdentifier(true)
            )
        );

        $cypher = <<<CYPHER
NOT NOT TRUE
CYPHER;

        self::assertEquals($cypher, $operator->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Operator\Logical\NotLogicalOperator
     */
    public function createComplexNestedNotOperators(): void
    {
        $operator = new NotLogicalOperator(
            new NotLogicalOperator(
                new NotLogicalOperator(
                    new ScalarIdentifier('foo')
                )
            )
        );

        $cypher = <<<CYPHER
NOT NOT NOT 'foo'
CYPHER;

        self::assertEquals($cypher, $operator->toString());
    }
}
