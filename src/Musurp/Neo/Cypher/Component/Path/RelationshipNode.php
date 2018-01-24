<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Component\Path;

use Musurp\Neo\Cypher\Component\AbstractNode;
use Musurp\Neo\Cypher\Component\Path;

/**
 * A path relationship node.
 */
final class RelationshipNode extends AbstractNode
{
    /**
     * {@inheritdoc}
     *
     * @return Relationship
     */
    public function variable(string $variable): Path
    {
        $this->variable = $variable;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return Relationship
     */
    public function label(string $label): Path
    {
        $this->labels[] = $label;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return Relationship
     */
    public function labels(array $labels): Path
    {
        $this->labels = $labels;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return Relationship
     */
    public function property(string $key, $value): Path
    {
        $this->properties[$key] = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return Relationship
     */
    public function properties(array $properties): Path
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function getNodeContainer(): string
    {
        return '[%s]';
    }

    /**
     * {@inheritdoc}
     */
    protected function getLabelGlue(): string
    {
        return '|';
    }
}
