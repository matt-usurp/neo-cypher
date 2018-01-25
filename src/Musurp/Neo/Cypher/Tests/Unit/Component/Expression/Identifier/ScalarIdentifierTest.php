<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Tests\Unit\Component\Expression\Identifier;

use Musurp\Neo\Cypher\Component\Expression\Identifier\ScalarIdentifier;

use PHPUnit\Framework\TestCase;

/**
 * {@inheritdoc}
 */
class ScalarIdentifierTest extends TestCase
{
    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Identifier\ScalarIdentifier
     */
    public function createWithNull(): void
    {
        $identifier = new ScalarIdentifier(null);

        self::assertEquals('NULL', $identifier->compile());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Identifier\ScalarIdentifier
     */
    public function createWithBooleanTrue(): void
    {
        $identifier = new ScalarIdentifier(true);

        self::assertEquals('TRUE', $identifier->compile());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Identifier\ScalarIdentifier
     */
    public function createWithBooleanFalse(): void
    {
        $identifier = new ScalarIdentifier(false);

        self::assertEquals('FALSE', $identifier->compile());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Identifier\ScalarIdentifier
     */
    public function createWithInteger(): void
    {
        $identifier = new ScalarIdentifier(123);

        self::assertEquals('123', $identifier->compile());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Identifier\ScalarIdentifier
     */
    public function createWithFloat(): void
    {
        $identifier = new ScalarIdentifier(12.3);

        self::assertEquals('12.3', $identifier->compile());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Expression\Identifier\ScalarIdentifier
     */
    public function createWithString(): void
    {
        $identifier = new ScalarIdentifier('hello');

        self::assertEquals('\'hello\'', $identifier->compile());
    }
}
