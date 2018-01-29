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
 * Implementation for clause: MATCH.
 */
final class MatchClause extends AbstractComponent
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

    public function paths(Path ...$paths): self
    {
        foreach ($paths as $path) {
            $this->path($path);
        }

        return $this;
    }

    /**
     * Return the expression as string.
     *
     * @param bool $pretty
     *
     * @return string
     */
    public function compile(bool $pretty = true): string
    {
        if (!$pretty || (count($this->paths) === 1)) {
            return sprintf('MATCH %s', implode(', ', $this->paths));
        }

        return sprintf("MATCH\n%s", $this->pad(implode(",\n", $this->paths)));
    }
}
