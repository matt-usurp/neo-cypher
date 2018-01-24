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

/**
 * A path node.
 */
final class Node extends AbstractNode
{
    /**
     * {@inheritdoc}
     *
     * @return Node
     */
    public function variable(string $variable): self
    {
        $this->variable = $variable;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return Node
     */
    public function label(string $label): self
    {
        $this->labels[] = $label;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return Node
     */
    public function labels(array $labels): self
    {
        $this->labels = $labels;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return Node
     */
    public function property(string $key, $value): self
    {
        $this->properties[$key] = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return Node
     */
    public function properties(array $properties): self
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function getNodeContainer(): string
    {
        return '(%s)';
    }

    /**
     * {@inheritdoc}
     */
    protected function getLabelGlue(): string
    {
        return ':';
    }
}
