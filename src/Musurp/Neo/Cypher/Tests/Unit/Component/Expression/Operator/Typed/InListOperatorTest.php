<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Tests\Unit\Component\Expression\Operator\Typed;

use Musurp\Neo\Cypher\Component\Expression\Identifier\ScalarIdentifier;
use Musurp\Neo\Cypher\Component\Expression\Operator\Typed\InListOperator;

use PHPUnit\Framework\TestCase;

/**
 * {@inheritdoc}
 */
class InListOperatorTest extends TestCase
{
    /**
     * Data provider.
     *
     * @return array
     */
    public function provideCreateWithScalarValuesDirect(): array
    {
        return [
            ['(TRUE IN TRUE)', true, true],
            ['(TRUE IN FALSE)', true, false],
            ['(NULL IN FALSE)', null, false],

            ['(1 IN 1)', 1, 1],
            ['(1 IN 100)', 1, 100],
            ['(1 IN 1.23)', 1, 1.23],
            ['(100 IN 1.23)', 100, 1.23],

            ['(\'foo\' IN \'bar\')', 'foo', 'bar'],
            ['(\'foo\' IN \'b\'ar\')', 'foo', 'b\'ar'],
        ];
    }

    /**
     * @test
     * @dataProvider provideCreateWithScalarValuesDirect
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Operator\Typed\InListOperator
     *
     * @param string $expected
     * @param mixed $left
     * @param mixed $right
     */
    public function createWithScalarValuesDirect(string $expected, $left, $right): void
    {
        $operator = new InListOperator($left, $right);
        self::assertEquals($expected, $operator->compile());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Operator\Typed\InListOperator
     */
    public function createWithIdentifierClasses(): void
    {
        $operator = new InListOperator(
            new ScalarIdentifier(true),
            new ScalarIdentifier(false)
        );

        $cypher = <<<CYPHER
(TRUE IN FALSE)
CYPHER;

        self::assertEquals($cypher, $operator->compile());
    }
}
