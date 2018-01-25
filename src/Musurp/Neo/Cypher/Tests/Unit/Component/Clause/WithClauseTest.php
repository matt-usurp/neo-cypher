<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Tests\Unit\Component\Clause;

use Musurp\Neo\Cypher\Component\Clause\WithClause;

use PHPUnit\Framework\TestCase;

/**
 * {@inheritdoc}
 */
class WithClauseTest extends TestCase
{
    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Clause\WithClause
     */
    public function createClauseEmptyThrows(): void
    {
        self::markTestIncomplete();

        $clause = new WithClause([]);
        $clause->toString();
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
        $clause = new WithClause(['one']);

        $cypher = <<<CYPHER
WITH one
CYPHER;

        self::assertEquals($cypher, $clause->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Clause\WithClause
     */
    public function createClauseMultipleVariables(): void
    {
        $clause = new WithClause(['one', 'two']);

        $cypher = <<<CYPHER
WITH one, two
CYPHER;

        self::assertEquals($cypher, $clause->toString());
    }
}
