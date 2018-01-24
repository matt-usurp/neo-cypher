<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Tests\Unit\Component\Path;

use Musurp\Neo\Cypher\Component\Path\RelationshipNode;

use PHPUnit\Framework\TestCase;

/**
 * {@inheritdoc}
 */
class RelationshipNodeTest extends TestCase
{
    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\RelationshipNode
     * @covers \Musurp\Neo\Cypher\Component\AbstractNode
     */
    public function createEmptyRelationshipNode(): void
    {
        $node = new RelationshipNode(null, [], []);

        $cypher = <<<CYPHER
[]
CYPHER;

        self::assertEquals($cypher, $node->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\RelationshipNode
     * @covers \Musurp\Neo\Cypher\Component\AbstractNode
     */
    public function createRelationshipNodeWithJustVariable(): void
    {
        $node = new RelationshipNode('var', [], []);

        $cypher = <<<CYPHER
[var]
CYPHER;

        self::assertEquals($cypher, $node->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\RelationshipNode
     * @covers \Musurp\Neo\Cypher\Component\AbstractNode
     */
    public function createRelationshipNodeWithJustOneLabel(): void
    {
        $node = new RelationshipNode(null, ['ONE'], []);

        $cypher = <<<CYPHER
[:ONE]
CYPHER;

        self::assertEquals($cypher, $node->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\RelationshipNode
     * @covers \Musurp\Neo\Cypher\Component\AbstractNode
     */
    public function createRelationshipNodeWithJustLabels(): void
    {
        $node = new RelationshipNode(null, ['ONE', 'TWO'], []);

        $cypher = <<<CYPHER
[:ONE|TWO]
CYPHER;

        self::assertEquals($cypher, $node->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\RelationshipNode
     * @covers \Musurp\Neo\Cypher\Component\AbstractNode
     */
    public function createRelationshipNodeWithJustProperty(): void
    {
        $node = new RelationshipNode(null, [], [
            'foo' => 'bar',
        ]);

        $cypher = <<<CYPHER
[{foo: 'bar'}]
CYPHER;

        self::assertEquals($cypher, $node->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\RelationshipNode
     * @covers \Musurp\Neo\Cypher\Component\AbstractNode
     */
    public function createRelationshipNodeWithJustProperties(): void
    {
        $node = new RelationshipNode(null, [], [
            'foo' => 'bar',
            'tony' => 'stark',
        ]);

        $cypher = <<<CYPHER
[{foo: 'bar', tony: 'stark'}]
CYPHER;

        self::assertEquals($cypher, $node->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\RelationshipNode
     * @covers \Musurp\Neo\Cypher\Component\AbstractNode
     */
    public function createRelationshipNodeWithVarableAndLabel(): void
    {
        $node = new RelationshipNode('var', ['ONE'], []);

        $cypher = <<<CYPHER
[var:ONE]
CYPHER;

        self::assertEquals($cypher, $node->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\RelationshipNode
     * @covers \Musurp\Neo\Cypher\Component\AbstractNode
     */
    public function createRelationshipNodeWithVariableAndProperty(): void
    {
        $node = new RelationshipNode('var', [], [
            'foo' => 'bar',
        ]);

        $cypher = <<<CYPHER
[var {foo: 'bar'}]
CYPHER;

        self::assertEquals($cypher, $node->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\RelationshipNode
     * @covers \Musurp\Neo\Cypher\Component\AbstractNode
     */
    public function createRelationshipNodeWithLabelAndProperty(): void
    {
        $node = new RelationshipNode(null, ['ONE'], [
            'foo' => 'bar',
        ]);

        $cypher = <<<CYPHER
[:ONE {foo: 'bar'}]
CYPHER;

        self::assertEquals($cypher, $node->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\RelationshipNode
     * @covers \Musurp\Neo\Cypher\Component\AbstractNode
     */
    public function createRelationshipNodeWithEverything(): void
    {
        $node = new RelationshipNode('var', ['ONE', 'TWO'], [
            'foo' => 'bar',
        ]);

        $cypher = <<<CYPHER
[var:ONE|TWO {foo: 'bar'}]
CYPHER;

        self::assertEquals($cypher, $node->toString());
    }
}
