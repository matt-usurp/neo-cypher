<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Tests\Unit\Component\Expression\Operator;

use Musurp\Neo\Cypher\Component\Expression\Identifier\ScalarIdentifier;
use Musurp\Neo\Cypher\Component\Expression\Operator\Logical\AndLogicalOperator;
use Musurp\Neo\Cypher\Component\Expression\Operator\Logical\NotLogicalOperator;
use Musurp\Neo\Cypher\Component\Expression\Operator\Logical\OrLogicalOperator;

use PHPUnit\Framework\TestCase;

/**
 * {@inheritdoc}
 */
class LogicalOperatorTest extends TestCase
{
    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @coversNothing
     */
    public function createBasicAndOperator(): void
    {
        $operator = new AndLogicalOperator(
            new ScalarIdentifier(true),
            new NotLogicalOperator(
                new OrLogicalOperator(
                    new ScalarIdentifier(1),
                    new AndLogicalOperator(
                        new ScalarIdentifier('foo'),
                        new ScalarIdentifier('bar')
                    )
                )
            )
        );

        $cypher = <<<CYPHER
(TRUE AND NOT (1 OR ('foo' AND 'bar')))
CYPHER;

        self::assertEquals($cypher, $operator->toString());
    }
}
