<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Builder\Statement;

use Musurp\Neo\Cypher\Builder\BuilderInterface;
use Musurp\Neo\Cypher\Builder\QueryBuilder;
use Musurp\Neo\Cypher\Component\Clause\WithClause;

class StatementSegment implements BuilderInterface
{
    private $builder;
    private $with;

    /**
     * Constructor.
     *
     * @param QueryBuilder $builder
     * @param WithClause $with
     */
    public function __construct(QueryBuilder $builder, WithClause $with)
    {
        $this->builder = $builder;
        $this->with = $with;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): string
    {
        return implode(PHP_EOL, [
            $this->builder->build(),
            $this->with->toString(),
        ]);
    }
}
