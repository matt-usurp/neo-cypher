<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Builder;

use Musurp\Neo\Cypher\Component\Clause\MatchClause;
use Musurp\Neo\Cypher\Component\Clause\WhereClause;
use Musurp\Neo\Cypher\Component\Path;
use Musurp\Neo\Cypher\Helper\ExpressionHelper;
use Musurp\Neo\Cypher\Helper\PathHelper;

class QueryBuilder implements BuilderInterface
{
    /** @var MatchClause[] */
    protected $matches = [];

    /** @var WhereClause */
    protected $where;

    public static function path(): PathHelper
    {
        static $helper;

        return $helper
            ?: $helper = new PathHelper();
    }

    public static function expr(): ExpressionHelper
    {
        static $helper;

        return $helper
            ?: $helper = new ExpressionHelper();
    }

    /**
     * {@inheritdoc}
     *
     * @param MatchClause|Path|Path[] $match
     *
     * @return QueryBuilder
     */
    public function match($match): self
    {
        if (is_array($match)) {
            $match = new MatchClause($match);
        } elseif ($match instanceof Path) {
            $match = new MatchClause([$match]);
        }

        $this->matches[] = $match;

        return $this;
    }

    public function where(WhereClause $where): self
    {
        $this->where = $where;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): string
    {
        $matches = null;
        $where = null;

        if (count($this->matches)) {
            $matches = implode(PHP_EOL, $this->matches);
        }

        if ($this->where instanceof WhereClause) {
            $where = $this->where->toString();
        }

        return implode(PHP_EOL, array_filter([
            $matches,
            $where,
        ]));
    }
}
