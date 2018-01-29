<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Builder;

use Musurp\Neo\Cypher\Builder\Statement\StatementSegment;
use Musurp\Neo\Cypher\Component\Clause\ReturnClause;
use Musurp\Neo\Cypher\Component\Clause\WithClause;

class StatementBuilder implements BuilderInterface
{
    /** @var StatementSegment[] */
    protected $segments = [];

    public function with(QueryBuilder $builder, array $variables): self
    {
        $this->segments[] = new StatementSegment($builder, new WithClause($variables));

        return $this;
    }

    public function return(QueryBuilder $builder, array $variables): self
    {
        $this->segments[] = new StatementSegment($builder, new ReturnClause($variables));

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): string
    {
        $strings = [];

        foreach ($this->segments as $segment) {
            $strings[] = $segment->build();
        }

        return implode("\n\n", $strings);
    }
}
