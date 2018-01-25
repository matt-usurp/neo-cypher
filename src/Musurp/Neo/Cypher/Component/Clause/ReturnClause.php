<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Component\Clause;

use Musurp\Neo\Cypher\Component\AbstractExitClause;

/**
 * Implementation for clause: RETURN.
 */
final class ReturnClause extends AbstractExitClause
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
    public function compile(): string
    {
        return sprintf('RETURN %s', implode(', ', $this->variables));
    }
}
