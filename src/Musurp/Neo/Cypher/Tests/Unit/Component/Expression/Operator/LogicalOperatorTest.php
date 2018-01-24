<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Tests\Unit\Component\Expression\Operator;

use Musurp\Neo\Cypher\Component\Expression\Input\DirectUserInput;
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
            new DirectUserInput(true),
            new NotLogicalOperator(
                new OrLogicalOperator(
                    new DirectUserInput(1),
                    new AndLogicalOperator(
                        new DirectUserInput('foo'),
                        new DirectUserInput('bar')
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
