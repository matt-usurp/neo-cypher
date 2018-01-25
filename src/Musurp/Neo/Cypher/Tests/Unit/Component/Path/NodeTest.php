<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Tests\Unit\Component\Path;

use Musurp\Neo\Cypher\Component\Path\Node;

use PHPUnit\Framework\TestCase;

/**
 * {@inheritdoc}
 */
class NodeTest extends TestCase
{
    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\Node
     * @covers \Musurp\Neo\Cypher\Component\AbstractNode
     */
    public function createEmptyNode(): void
    {
        $node = new Node(null, [], []);

        $cypher = <<<CYPHER
()
CYPHER;

        self::assertEquals($cypher, $node->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\Node
     * @covers \Musurp\Neo\Cypher\Component\AbstractNode
     */
    public function createNodeWithJustVariable(): void
    {
        $node = new Node('var', [], []);

        $cypher = <<<CYPHER
(var)
CYPHER;

        self::assertEquals($cypher, $node->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\Node
     * @covers \Musurp\Neo\Cypher\Component\AbstractNode
     */
    public function createNodeWithJustOneLabel(): void
    {
        $node = new Node(null, ['ONE'], []);

        $cypher = <<<CYPHER
(:ONE)
CYPHER;

        self::assertEquals($cypher, $node->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\Node
     * @covers \Musurp\Neo\Cypher\Component\AbstractNode
     */
    public function createNodeWithJustLabels(): void
    {
        $node = new Node(null, ['ONE', 'TWO'], []);

        $cypher = <<<CYPHER
(:ONE:TWO)
CYPHER;

        self::assertEquals($cypher, $node->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\Node
     * @covers \Musurp\Neo\Cypher\Component\AbstractNode
     */
    public function createNodeWithJustProperty(): void
    {
        $node = new Node(null, [], [
            'foo' => 'bar',
        ]);

        $cypher = <<<CYPHER
({foo: 'bar'})
CYPHER;

        self::assertEquals($cypher, $node->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\Node
     * @covers \Musurp\Neo\Cypher\Component\AbstractNode
     */
    public function createNodeWithJustProperties(): void
    {
        $node = new Node(null, [], [
            'foo' => 'bar',
            'tony' => 'stark',
        ]);

        $cypher = <<<CYPHER
({foo: 'bar', tony: 'stark'})
CYPHER;

        self::assertEquals($cypher, $node->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\Node
     * @covers \Musurp\Neo\Cypher\Component\AbstractNode
     */
    public function createNodeWithVariableAndLabel(): void
    {
        $node = new Node('var', ['ONE'], []);

        $cypher = <<<CYPHER
(var:ONE)
CYPHER;

        self::assertEquals($cypher, $node->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\Node
     * @covers \Musurp\Neo\Cypher\Component\AbstractNode
     */
    public function createNodeWithVarAndProperty(): void
    {
        $node = new Node('var', [], [
            'foo' => 'bar',
        ]);

        $cypher = <<<CYPHER
(var {foo: 'bar'})
CYPHER;

        self::assertEquals($cypher, $node->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\Node
     * @covers \Musurp\Neo\Cypher\Component\AbstractNode
     */
    public function createNodeWithLabelAndProperty(): void
    {
        $node = new Node(null, ['ONE'], [
            'foo' => 'bar',
        ]);

        $cypher = <<<CYPHER
(:ONE {foo: 'bar'})
CYPHER;

        self::assertEquals($cypher, $node->toString());
    }

    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path\Node
     * @covers \Musurp\Neo\Cypher\Component\AbstractNode
     */
    public function createNodeWithEverything(): void
    {
        $node = new Node('var', ['ONE', 'TWO'], [
            'foo' => 'bar',
        ]);

        $cypher = <<<CYPHER
(var:ONE:TWO {foo: 'bar'})
CYPHER;

        self::assertEquals($cypher, $node->toString());
    }
}
