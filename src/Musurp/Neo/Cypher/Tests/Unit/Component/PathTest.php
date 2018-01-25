<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Tests\Unit\Component;

use Musurp\Neo\Cypher\Component\Path;
use Musurp\Neo\Cypher\Component\Path\Node;
use Musurp\Neo\Cypher\Component\Path\RelationshipNode;

use PHPUnit\Framework\TestCase;

/**
 * {@inheritdoc}
 */
class PathTest extends TestCase
{
    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path
     */
    public function createPathWithNoRelationships(): void
    {
        $node = new Node(null, [], []);
        $path = new Path($node);

        $cypher = <<<CYPHER
()
CYPHER;

        self::assertEquals($cypher, $path->compile());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path
     */
    public function createPathWithDirectAnyRelationship(): void
    {
        $node = new Node(null, [], []);
        $path = new Path($node);
        $path->relatesAny($node);

        $cypher = <<<CYPHER
()--()
CYPHER;

        self::assertEquals($cypher, $path->compile());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path
     */
    public function createPathWithDirectToRelationship(): void
    {
        $node = new Node(null, [], []);
        $path = new Path($node);
        $path->relatesTo($node);

        $cypher = <<<CYPHER
()-->()
CYPHER;

        self::assertEquals($cypher, $path->compile());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path
     */
    public function createPathWithDirectFromRelationship(): void
    {
        $node = new Node(null, [], []);
        $path = new Path($node);
        $path->relatesFrom($node);

        $cypher = <<<CYPHER
()<--()
CYPHER;

        self::assertEquals($cypher, $path->compile());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path
     */
    public function createPathWithAnyRelationshipNode(): void
    {
        $node = new Node(null, [], []);
        $path = new Path($node);
        $path->relatesAny($node, new RelationshipNode(null, [], []));

        $cypher = <<<CYPHER
()-[]-()
CYPHER;

        self::assertEquals($cypher, $path->compile());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path
     */
    public function createPathWithToRelationshipNode(): void
    {
        $node = new Node(null, [], []);
        $path = new Path($node);
        $path->relatesTo($node, new RelationshipNode(null, [], []));

        $cypher = <<<CYPHER
()-[]->()
CYPHER;

        self::assertEquals($cypher, $path->compile());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path
     */
    public function createPathWithFromRelationshipNode(): void
    {
        $node = new Node(null, [], []);
        $path = new Path($node);
        $path->relatesFrom($node, new RelationshipNode(null, [], []));

        $cypher = <<<CYPHER
()<-[]-()
CYPHER;

        self::assertEquals($cypher, $path->compile());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path
     */
    public function canBuildStringFromAnyPath(): void
    {
        $node = new Node(null, [], []);
        $a = new Path($node);

        $b = $a->relatesAny($node);
        $c = $b->relatesAny($node);

        $cypher = <<<CYPHER
()--()--()
CYPHER;

        self::assertEquals($cypher, $a->compile());
        self::assertEquals($cypher, $b->compile());
        self::assertEquals($cypher, $c->compile());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path
     */
    public function createMultipleRelationshipPath(): void
    {
        $node = new Node(null, [], []);
        $path = new Path($node);

        $path
            ->relatesAny($node)
            ->relatesAny($node);

        $cypher = <<<CYPHER
()--()--()
CYPHER;

        self::assertEquals($cypher, $path->compile());
    }
}
