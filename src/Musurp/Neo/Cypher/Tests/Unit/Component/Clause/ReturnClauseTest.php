<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Tests\Unit\Component\Clause;

use Musurp\Neo\Cypher\Component\Clause\ReturnClause;

use PHPUnit\Framework\TestCase;

/**
 * {@inheritdoc}
 */
class ReturnClauseTest extends TestCase
{
    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Clause\ReturnClause
     */
    public function createClauseEmptyThrows(): void
    {
        self::markTestIncomplete();

        $clause = new ReturnClause([]);
        $clause->compile();
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Clause\WithClause
     */
    public function createClauseSingleVariable(): void
    {
        $clause = new ReturnClause(['one']);

        $cypher = <<<CYPHER
RETURN one
CYPHER;

        self::assertEquals($cypher, $clause->compile());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Clause\ReturnClause
     */
    public function createClauseMultipleVariables(): void
    {
        $clause = new ReturnClause(['one', 'two']);

        $cypher = <<<CYPHER
RETURN
  one,
  two
CYPHER;

        self::assertEquals($cypher, $clause->compile());
    }
}
