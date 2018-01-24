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
MATCH (:ONE), (var:ONE {foo: 'bar'})
CYPHER;

        self::assertEquals($cypher, $builder->build());
    }
}
