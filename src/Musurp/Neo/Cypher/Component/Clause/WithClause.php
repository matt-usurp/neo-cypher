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
 * Implementation for clause: WITH.
 */
final class WithClause extends AbstractComponent
{
    private $variables;

    /**
     * Constructor.
     *
     * @param string[] $variables
     */
    public function __construct(array $variables)
    {
        $this->variables = $variables;
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        return sprintf('WITH %s', implode(', ', $this->variables));
    }
}
