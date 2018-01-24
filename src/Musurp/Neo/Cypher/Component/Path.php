<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Component;

use Musurp\Neo\Cypher\AbstractComponent;
use Musurp\Neo\Cypher\Component\Enum\RelationshipDirectionEnum;
use Musurp\Neo\Cypher\Component\Path\Node;
use Musurp\Neo\Cypher\Component\Path\Relationship;
use Musurp\Neo\Cypher\Component\Path\RelationshipNode;

/**
 * A cypher path.
 */
final class Path extends AbstractComponent implements RelationshipDirectionEnum
{
    /** @var Node */
    protected $node;

    /** @var Relationship|null */
    protected $relationship;

    /** @var Path */
    protected $root;

    /** @var Path|null */
    protected $parent;

    /** @var Path|null */
    protected $child;

    /**
     * Constructor.
     *
     * @param Node $node
     */
    public function __construct(Node $node)
    {
        $this->node = $node;
        $this->root = $this;
    }

    public function relate(string $direction, Node $node, RelationshipNode $relationship = null): self
    {
        $this->relationship = new Relationship($relationship, $direction);

        $child = new self($node);
        $child->root = $this->root;
        $child->parent = $this;

        return $this->child = $child;
    }

    public function relatesAny(Node $node, RelationshipNode $relationship = null): self
    {
        return $this->relate(self::DIRECTION_ANY, $node, $relationship);
    }

    public function relatesTo(Node $node, RelationshipNode $relationship = null): self
    {
        return $this->relate(self::DIRECTION_TO, $node, $relationship);
    }

    public function relatesFrom(Node $node, RelationshipNode $relationship = null): self
    {
        return $this->relate(self::DIRECTION_FROM, $node, $relationship);
    }

    /**
     * Return the root path component.
     *
     * @return Path
     */
    public function getRoot(): self
    {
        return $this->root;
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        if ($this->root !== $this) {
            return $this->root->toString();
        }

        return $this->toStringFromCurrent();
    }

    /**
     * Return the expression as string from the current node.
     *
     * @return string
     */
    protected function toStringFromCurrent(): string
    {
        if (!$this->relationship instanceof Relationship) {
            return $this->node->toString();
        }

        return sprintf(
            '%s%s%s',
            $this->node->toString(),
            $this->relationship->toString(),
            $this->child->toStringFromCurrent()
        );
    }
}
