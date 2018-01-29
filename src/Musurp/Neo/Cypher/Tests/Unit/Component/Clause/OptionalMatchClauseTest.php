<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Tests\Unit\Component\Clause;

use Musurp\Neo\Cypher\Component\Clause\MatchClause;
use Musurp\Neo\Cypher\Component\Clause\OptionalMatchClause;
use Musurp\Neo\Cypher\Component\Path;
use Musurp\Neo\Cypher\Component\Path\Node;
use Musurp\Neo\Cypher\Exception\ComponentRuntimeException;

use PHPUnit\Framework\TestCase;

/**
 * {@inheritdoc}
 */
class OptionalMatchClauseTest extends TestCase
{
    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Clause\OptionalMatchClause
     */
    public function createWithEmptyMatchClauseEmptyThrows(): void
    {
        self::markTestIncomplete();

        self::expectException(ComponentRuntimeException::class);

        $clause = new OptionalMatchClause(new MatchClause());
        $clause->compile();
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Clause\OptionalMatchClause
     */
    public function createClauseSinglePath(): void
    {
        $clause = new MatchClause();
        $clause->path(
            (new Path(new Node(null, ['ONE'], [])))
        );

        $clause = new OptionalMatchClause($clause);

        $cypher = <<<CYPHER
OPTIONAL MATCH (:ONE)
CYPHER;

        self::assertEquals($cypher, $clause->compile());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Clause\OptionalMatchClause
     */
    public function createClauseSinglePathWithoutPrettyHasNoEffect(): void
    {
        $clause = new MatchClause();
        $clause->path(
            (new Path(new Node(null, ['ONE'], [])))
        );

        $clause = new OptionalMatchClause($clause);

        $cypher = <<<CYPHER
OPTIONAL MATCH (:ONE)
CYPHER;

        self::assertEquals($cypher, $clause->compile(false));
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Clause\OptionalMatchClause
     */
    public function createClauseMultiplePaths(): void
    {
        $clause = new MatchClause();
        $clause->paths(
            (new Path(new Node(null, ['ONE'], []))),
            (new Path(new Node(null, [], [
                'foo' => 'bar',
            ])))
        );

        $clause = new OptionalMatchClause($clause);

        $cypher = <<<CYPHER
OPTIONAL MATCH
  (:ONE),
  ({foo: 'bar'})
CYPHER;

        self::assertEquals($cypher, $clause->compile());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Clause\OptionalMatchClause
     */
    public function createClauseMultiplePathsWithoutPretty(): void
    {
        $clause = new MatchClause();
        $clause->paths(
            (new Path(new Node(null, ['ONE'], []))),
            (new Path(new Node(null, [], [
                'foo' => 'bar',
            ])))
        );

        $clause = new OptionalMatchClause($clause);

        $cypher = <<<CYPHER
OPTIONAL MATCH (:ONE), ({foo: 'bar'})
CYPHER;

        self::assertEquals($cypher, $clause->compile(false));
    }
}
