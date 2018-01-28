<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Tests\Unit\Utility;

use Musurp\Neo\Cypher\Component\Expression\Identifier\ScalarIdentifier;
use Musurp\Neo\Cypher\Component\Expression\Operator\Logical\AndLogicalOperator;
use Musurp\Neo\Cypher\Utility\HashMapHelper;

use PHPUnit\Framework\TestCase;

/**
 * {@inheritdoc}
 */
class HashMapHelperTest extends TestCase
{
    /**
     * @test
     *
     * @group unit
     * @group utility
     *
     * @covers \Musurp\Neo\Cypher\Utility\HashMapHelper
     */
    public function canConvertEmptyHashMap(): void
    {
        $input = [];

        $cypher = <<<CYPHER
{}
CYPHER;

        self::assertEquals($cypher, HashMapHelper::map($input));
    }

    /**
     * @test
     *
     * @group unit
     * @group utility
     *
     * @covers \Musurp\Neo\Cypher\Utility\HashMapHelper
     */
    public function canConvertStringValue(): void
    {
        $input = [
            'string' => 'foo',
        ];

        $cypher = <<<CYPHER
{string: 'foo'}
CYPHER;

        self::assertEquals($cypher, HashMapHelper::map($input));
    }

    /**
     * @test
     *
     * @group unit
     * @group utility
     *
     * @covers \Musurp\Neo\Cypher\Utility\HashMapHelper
     */
    public function canConvertIntegerValue(): void
    {
        $input = [
            'integer' => 1,
        ];

        $cypher = <<<CYPHER
{integer: 1}
CYPHER;

        self::assertEquals($cypher, HashMapHelper::map($input));
    }

    /**
     * @test
     *
     * @group unit
     * @group utility
     *
     * @covers \Musurp\Neo\Cypher\Utility\HashMapHelper
     */
    public function canConvertFloatValue(): void
    {
        $input = [
            'float' => 1.123,
        ];

        $cypher = <<<CYPHER
{float: 1.123}
CYPHER;

        self::assertEquals($cypher, HashMapHelper::map($input));
    }

    /**
     * @test
     *
     * @group unit
     * @group utility
     *
     * @covers \Musurp\Neo\Cypher\Utility\HashMapHelper
     */
    public function canConvertBooleanTrue(): void
    {
        $input = [
            'boolean' => true,
        ];

        $cypher = <<<CYPHER
{boolean: 1}
CYPHER;

        self::assertEquals($cypher, HashMapHelper::map($input));
    }

    /**
     * @test
     *
     * @group unit
     * @group utility
     *
     * @covers \Musurp\Neo\Cypher\Utility\HashMapHelper
     */
    public function canConvertBooleanFalse(): void
    {
        $input = [
            'boolean' => false,
        ];

        $cypher = <<<CYPHER
{boolean: 0}
CYPHER;

        self::assertEquals($cypher, HashMapHelper::map($input));
    }

    /**
     * @test
     *
     * @group unit
     * @group utility
     *
     * @covers \Musurp\Neo\Cypher\Utility\HashMapHelper
     */
    public function canConvertNull(): void
    {
        $input = [
            'null' => null,
        ];

        $cypher = <<<CYPHER
{null: null}
CYPHER;

        self::assertEquals($cypher, HashMapHelper::map($input));
    }

    /**
     * @test
     *
     * @group unit
     * @group utility
     *
     * @covers \Musurp\Neo\Cypher\Utility\HashMapHelper
     */
    public function canHandleMultipleElements(): void
    {
        $input = [
            'boolean' => false,
            'integer' => 87,
            'string' => 'foo-bar',
        ];

        $cypher = <<<CYPHER
{boolean: 0, integer: 87, string: 'foo-bar'}
CYPHER;

        self::assertEquals($cypher, HashMapHelper::map($input));
    }

    /**
     * @test
     *
     * @group unit
     * @group utility
     *
     * @covers \Musurp\Neo\Cypher\Utility\HashMapHelper
     */
    public function canConvertChildArray(): void
    {
        $input = [
            'array' => [
                'integer' => 1,
            ],
        ];

        $cypher = <<<CYPHER
{array: {integer: 1}}
CYPHER;

        self::assertEquals($cypher, HashMapHelper::map($input));
    }

    /**
     * @test
     *
     * @group unit
     * @group utility
     *
     * @covers \Musurp\Neo\Cypher\Utility\HashMapHelper
     */
    public function withEmptyArrayReturnBlankHashStructure(): void
    {
        $input = [];

        $cypher = <<<CYPHER
{}
CYPHER;

        self::assertEquals($cypher, HashMapHelper::map($input));
    }

    /**
     * @test
     *
     * @group unit
     * @group utility
     *
     * @covers \Musurp\Neo\Cypher\Utility\HashMapHelper
     */
    public function withEmptyChildArrayIgnore(): void
    {
        $input = [
            'integer' => 1,
            'array' => [],
        ];

        $cypher = <<<CYPHER
{integer: 1}
CYPHER;

        self::assertEquals($cypher, HashMapHelper::map($input));
    }

    /**
     * @test
     *
     * @group unit
     * @group utility
     *
     * @covers \Musurp\Neo\Cypher\Utility\HashMapHelper
     */
    public function withEmptyChildOnlyReturnBlankStructure(): void
    {
        $input = [
            'array' => [],
        ];

        $cypher = <<<CYPHER
{}
CYPHER;

        self::assertEquals($cypher, HashMapHelper::map($input));
    }

    /**
     * @test
     *
     * @group unit
     * @group utility
     *
     * @covers \Musurp\Neo\Cypher\Utility\HashMapHelper
     */
    public function withAbstractComponentCompile(): void
    {
        $input = [
            'component' => new AndLogicalOperator(
                new ScalarIdentifier(true),
                new ScalarIdentifier(34)
            ),
        ];

        $cypher = <<<CYPHER
{component: (
  TRUE
  AND 34
)}
CYPHER;

        self::assertEquals($cypher, HashMapHelper::map($input));
    }
}
