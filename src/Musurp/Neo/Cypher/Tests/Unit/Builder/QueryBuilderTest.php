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
use Musurp\Neo\Cypher\Component\Clause\MatchClause;
use Musurp\Neo\Cypher\Component\Clause\OptionalMatchClause;

use PHPUnit\Framework\TestCase;

/**
 * {@inheritdoc}
 */
class QueryBuilderTest extends TestCase
{
    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Builder\QueryBuilder
     */
    public function createEmptyQueryBuilderThrows(): void
    {
        $this->markTestIncomplete();

        $builder = new QueryBuilder();
        $builder->build();
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Builder\QueryBuilder
     */
    public function createQueryBuilderWithSingleMatch(): void
    {
        $builder = new QueryBuilder();
        $builder->match($builder::path()->create(null, [], []));

        $cypher = <<<CYPHER
MATCH ()
CYPHER;

        self::assertEquals($cypher, $builder->build());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Builder\QueryBuilder
     */
    public function createQueryBuilderWithSingleOptionalMatch(): void
    {
        $builder = new QueryBuilder();
        $builder->match($builder::path()->create(null, [], []), true);

        $cypher = <<<CYPHER
OPTIONAL MATCH ()
CYPHER;

        self::assertEquals($cypher, $builder->build());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Builder\QueryBuilder
     */
    public function createQueryBuilderWithMultipleMatches(): void
    {
        $builder = new QueryBuilder();
        $builder->match($builder::path()->create(null, [], []));
        $builder->match($builder::path()->create(null, ['ONE'], []));

        $cypher = <<<CYPHER
MATCH ()
MATCH (:ONE)
CYPHER;

        self::assertEquals($cypher, $builder->build());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Builder\QueryBuilder
     */
    public function createQueryBuilderWithMultipleOptionalMatches(): void
    {
        $builder = new QueryBuilder();
        $builder->match($builder::path()->create(null, [], []), true);
        $builder->match($builder::path()->create(null, ['ONE'], []), true);

        $cypher = <<<CYPHER
OPTIONAL MATCH ()
OPTIONAL MATCH (:ONE)
CYPHER;

        self::assertEquals($cypher, $builder->build());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Builder\QueryBuilder
     */
    public function createQueryBuilderWithMultipleMatchesMultiplePaths(): void
    {
        $builder = new QueryBuilder();
        $builder->match($builder::path()->create(null, [], []));
        $builder->match([
            $builder::path()->create(null, ['ONE'], []),
            $builder::path()->create('var', ['ONE'], [
                'foo' => 'bar',
            ]),
        ]);

        $cypher = <<<CYPHER
MATCH ()
MATCH
  (:ONE),
  (var:ONE {foo: 'bar'})
CYPHER;

        self::assertEquals($cypher, $builder->build());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Builder\QueryBuilder
     */
    public function createQueryBuilderWithMatchInstance(): void
    {
        $builder = new QueryBuilder();
        $builder->match(
            new MatchClause([
                $builder::path()->node(null, [], []),
            ])
        );

        $cypher = <<<CYPHER
MATCH ()
CYPHER;

        self::assertEquals($cypher, $builder->build());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Builder\QueryBuilder
     */
    public function createQueryBuilderWithOptionalMatchInstance(): void
    {
        $builder = new QueryBuilder();
        $builder->match(
            new OptionalMatchClause(
                new MatchClause([
                    $builder::path()->node(null, [], []),
                ])
            )
        );

        $cypher = <<<CYPHER
OPTIONAL MATCH ()
CYPHER;

        self::assertEquals($cypher, $builder->build());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Builder\QueryBuilder
     */
    public function createQueryBuilderWithMatchAndWhere(): void
    {
        $builder = new QueryBuilder();
        $builder->match(
            $builder::path()->create('var', ['ONE'], [
                'foo' => 'bar',
            ])
        );

        $builder->where(
            $builder::expr()->andX(
                $builder::expr()->eq(1, 'hello'),
                $builder::path()->create('var', ['TWO'], [])
            )
        );

        $cypher = <<<CYPHER
MATCH (var:ONE {foo: 'bar'})
WHERE (
  (1 = 'hello')
  AND (var:TWO)
)
CYPHER;

        self::assertEquals($cypher, $builder->build());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Builder\QueryBuilder
     */
    public function createQueryBuilderWithMatchAndWhereAndReturn(): void
    {
        $builder = new QueryBuilder();
        $builder->match(
            $builder::path()->create('var', ['ONE'], [
                'foo' => 'bar',
            ])
        );

        $builder->where(
            $builder::expr()->andX(
                $builder::expr()->eq(1, 'hello'),
                $builder::path()->create('var', ['TWO'], []),
                $builder::expr()->lt(1, 2)
            )
        );

        $builder->return(['var']);

        $cypher = <<<CYPHER
MATCH (var:ONE {foo: 'bar'})
WHERE (
  (1 = 'hello')
  AND (var:TWO)
  AND (1 < 2)
)
RETURN var
CYPHER;

        self::assertEquals($cypher, $builder->build());
    }
}
