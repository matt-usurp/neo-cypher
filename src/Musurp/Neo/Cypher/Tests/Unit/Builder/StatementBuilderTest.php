<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Tests\Unit\Builder;

use Musurp\Neo\Cypher\Builder\QueryBuilder;
use Musurp\Neo\Cypher\Builder\StatementBuilder;

use PHPUnit\Framework\TestCase;

/**
 * {@inheritdoc}
 */
class StatementBuilderTest extends TestCase
{
    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Builder\StatementBuilder
     */
    public function createStatementBuilderEmptyThrow(): void
    {
        self::markTestIncomplete();

        $statement = new StatementBuilder();
        $statement->build();
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Builder\StatementBuilder
     */
    public function createStatementBuilderSingleSegment(): void
    {
        $builder = new QueryBuilder();
        $builder->match($builder::path()->create('a', [], []));

        $statement = new StatementBuilder();
        $statement->with($builder, ['a']);

        $cypher = <<<CYPHER
MATCH (a)
WITH a
CYPHER;

        self::assertEquals($cypher, $statement->build());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Builder\StatementBuilder
     */
    public function createStatementBuilderSingleSegmentComplex(): void
    {
        $builder = new QueryBuilder();
        $builder->match([
            $builder::path()->create('a', ['ONE'], []),
            $builder::path()->create('b', ['TWO'], [])
                ->relatesTo(
                    $builder::path()->node(null, [], []),
                    $builder::path()->relationshipNode(null, ['THREE'], [])
                ),
        ]);

        $statement = new StatementBuilder();
        $statement->with($builder, ['a', 'b']);

        $cypher = <<<CYPHER
MATCH (a:ONE), (b:TWO)-[:THREE]->()
WITH a, b
CYPHER;

        self::assertEquals($cypher, $statement->build());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Builder\StatementBuilder
     */
    public function createStatementBuilderMultipleSegments(): void
    {
        $builder = new QueryBuilder();
        $builder->match([
            $builder::path()->create('a', ['ONE'], []),
            $builder::path()->create('b', ['TWO'], [])
                ->relatesTo(
                    $builder::path()->node(null, [], []),
                    $builder::path()->relationshipNode(null, ['THREE'], [])
                ),
        ]);

        $statement = new StatementBuilder();
        $statement->with($builder, ['a', 'b']);
        $statement->with($builder, ['c']);

        $cypher = <<<CYPHER
MATCH (a:ONE), (b:TWO)-[:THREE]->()
WITH a, b
MATCH (a:ONE), (b:TWO)-[:THREE]->()
WITH c
CYPHER;

        self::assertEquals($cypher, $statement->build());
    }
}
