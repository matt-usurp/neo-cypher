<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Tests\Unit\Component\Expression\Operator\Comparison;

use Musurp\Neo\Cypher\Component\Expression\Identifier\ScalarIdentifier;
use Musurp\Neo\Cypher\Component\Expression\Operator\Comparison\NotEqualComparisonOperator;

use PHPUnit\Framework\TestCase;

/**
 * {@inheritdoc}
 */
class NotEqualComparisonOperatorTest extends TestCase
{
    /**
     * Data provider.
     *
     * @return array
     */
    public function provideCreateWithScalarValuesDirect(): array
    {
        return [
            ['(TRUE <> TRUE)', true, true],
            ['(TRUE <> FALSE)', true, false],
            ['(NULL <> FALSE)', null, false],

            ['(1 <> 1)', 1, 1],
            ['(1 <> 100)', 1, 100],
            ['(1 <> 1.23)', 1, 1.23],
            ['(100 <> 1.23)', 100, 1.23],

            ['(\'foo\' <> \'bar\')', 'foo', 'bar'],
            ['(\'foo\' <> \'b\'ar\')', 'foo', 'b\'ar'],
        ];
    }

    /**
     * @test
     * @dataProvider provideCreateWithScalarValuesDirect
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Operator\Comparison\NotEqualComparisonOperator
     *
     * @param string $expected
     * @param mixed $left
     * @param mixed $right
     */
    public function createWithScalarValuesDirect(string $expected, $left, $right): void
    {
        $operator = new NotEqualComparisonOperator($left, $right);
        self::assertEquals($expected, $operator->compile());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Operator\Comparison\NotEqualComparisonOperator
     */
    public function createWithIdentifierClasses(): void
    {
        $operator = new NotEqualComparisonOperator(
            new ScalarIdentifier(true),
            new ScalarIdentifier(false)
        );

        $cypher = <<<CYPHER
(TRUE <> FALSE)
CYPHER;

        self::assertEquals($cypher, $operator->compile());
    }
}
