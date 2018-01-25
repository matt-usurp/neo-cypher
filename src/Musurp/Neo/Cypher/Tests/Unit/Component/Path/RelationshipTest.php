<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Tests\Unit\Component\Path;

use Musurp\Neo\Cypher\Component\Path\Relationship;
use Musurp\Neo\Cypher\Component\Path\RelationshipNode;

use PHPUnit\Framework\TestCase;

/**
 * {@inheritdoc}
 */
class RelationshipTest extends TestCase
{
    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\Relationship
     */
    public function createEmptyAnyRelationship(): void
    {
        $relationship = new Relationship(null, Relationship::DIRECTION_ANY);

        $cypher = <<<CYPHER
--
CYPHER;

        self::assertEquals($cypher, $relationship->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\Relationship
     */
    public function createEmptyToRelationship(): void
    {
        $relationship = new Relationship(null, Relationship::DIRECTION_TO);

        $cypher = <<<CYPHER
-->
CYPHER;

        self::assertEquals($cypher, $relationship->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\Relationship
     */
    public function createEmptyFromRelationship(): void
    {
        $relationship = new Relationship(null, Relationship::DIRECTION_FROM);

        $cypher = <<<CYPHER
<--
CYPHER;

        self::assertEquals($cypher, $relationship->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\Relationship
     */
    public function createAnyRelationship(): void
    {
        $node = new RelationshipNode(null, [], []);
        $relationship = new Relationship($node, Relationship::DIRECTION_ANY);

        $cypher = <<<CYPHER
-[]-
CYPHER;

        self::assertEquals($cypher, $relationship->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\Relationship
     */
    public function createToRelationship(): void
    {
        $node = new RelationshipNode(null, [], []);
        $relationship = new Relationship($node, Relationship::DIRECTION_TO);

        $cypher = <<<CYPHER
-[]->
CYPHER;

        self::assertEquals($cypher, $relationship->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\Relationship
     */
    public function createFromRelationship(): void
    {
        $node = new RelationshipNode(null, [], []);
        $relationship = new Relationship($node, Relationship::DIRECTION_FROM);

        $cypher = <<<CYPHER
<-[]-
CYPHER;

        self::assertEquals($cypher, $relationship->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\Relationship
     */
    public function createRelationship(): void
    {
        $node = new RelationshipNode(null, ['ONE'], []);
        $relationship = new Relationship($node, Relationship::DIRECTION_ANY);

        $cypher = <<<CYPHER
-[:ONE]-
CYPHER;

        self::assertEquals($cypher, $relationship->toString());
    }
}
