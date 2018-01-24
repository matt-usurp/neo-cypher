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
use Musurp\Neo\Cypher\Component\Expression\Operator\Comparison\EqualComparisonOperator;

use PHPUnit\Framework\TestCase;

/**
 * {@inheritdoc}
 */
class EqualComparisonOperatorTest extends TestCase
{
    /**
     * Data provider.
     *
     * @return array
     */
    public function provideCreateWithScalarValuesDirect(): array
    {
        return [
            ['(TRUE = TRUE)', true, true],
            ['(TRUE = FALSE)', true, false],
            ['(NULL = FALSE)', null, false],

            ['(1 = 1)', 1, 1],
            ['(1 = 100)', 1, 100],
            ['(1 = 1.23)', 1, 1.23],
            ['(100 = 1.23)', 100, 1.23],

            ['(\'foo\' = \'bar\')', 'foo', 'bar'],
            ['(\'foo\' = \'b\'ar\')', 'foo', 'b\'ar'],
        ];
    }

    /**
     * @test
     * @dataProvider provideCreateWithScalarValuesDirect
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Operator\Comparison\EqualComparisonOperator
     *
     * @param string $expected
     * @param mixed $left
     * @param mixed $right
     */
    public function createWithScalarValuesDirect(string $expected, $left, $right): void
    {
        $operator = new EqualComparisonOperator($left, $right);
        self::assertEquals($expected, $operator->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Operator\Comparison\EqualComparisonOperator
     */
    public function createWithIdentifierClasses(): void
    {
        $operator = new EqualComparisonOperator(
            new ScalarIdentifier(true),
            new ScalarIdentifier(false)
        );

        $cypher = <<<CYPHER
(TRUE = FALSE)
CYPHER;

        self::assertEquals($cypher, $operator->toString());
    }
}
