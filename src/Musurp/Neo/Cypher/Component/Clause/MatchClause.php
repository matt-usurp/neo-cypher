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
use Musurp\Neo\Cypher\Component\Path;

/**
 * A match clause.
 */
class MatchClause extends AbstractComponent
{
    /** @var Path[] */
    protected $paths;

    /**
     * Constructor.
     *
     * @param Path[] $paths
     */
    public function __construct(array $paths = [])
    {
        $this->paths = $paths;
    }

    public function path(Path $path): self
    {
        $this->paths[] = $path->getRoot();

        return $this;
    }

    public function paths(array $paths): self
    {
        foreach ($paths as $path) {
            $this->path($path);
        }

        return $this;
    }

    /**
     * Return the expression as string.
     *
     * @return string
     */
    public function toString(): string
    {
        return sprintf('MATCH %s', implode(', ', $this->paths));
    }
}
