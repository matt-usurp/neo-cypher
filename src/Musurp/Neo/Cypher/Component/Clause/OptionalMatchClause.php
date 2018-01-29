<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Component\Clause;

use Musurp\Neo\Cypher\AbstractComponent;

/**
 * Implementation for clause: OPTIONAL MATCH.
 */
final class OptionalMatchClause extends AbstractComponent
{
    /** @var MatchClause */
    protected $match;

    /**
     * Constructor.
     *
     * @param MatchClause $match
     */
    public function __construct(MatchClause $match)
    {
        $this->match = $match;
    }

    /**
     * {@inheritdoc}
     */
    public function compile(bool $pretty = true): string
    {
        return sprintf('OPTIONAL %s', $this->match->compile($pretty));
    }
}
