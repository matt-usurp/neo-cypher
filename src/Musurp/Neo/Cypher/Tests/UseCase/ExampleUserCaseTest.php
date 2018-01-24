<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Tests\UseCase;

use Musurp\Neo\Cypher\Builder\QueryBuilder;

use PHPUnit\Framework\TestCase;

class ExampleUserCaseTest extends TestCase
{
    /**
     * @test
     */
    public function a(): void
    {
        $qb = new QueryBuilder();

        $qb->match(
            $qb::path()->create(null, ['EXAMPLE'], [])
                ->relatesAny(
                    $qb::path()->node('var', [], []),
                    $qb::path()->relationshipNode(null, [], [])
                )
                ->relatesFrom(
                    $qb::path()->node(null, ['SOMETHING'], []),
                    $qb::path()->relationshipNode(null, ['FIRST', 'SECOND'], [])
                )
        );

        self::assertTrue(true);
    }
}
