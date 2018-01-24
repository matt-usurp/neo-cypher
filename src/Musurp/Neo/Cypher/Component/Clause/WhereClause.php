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

class WhereClause extends AbstractComponent
{
    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        return 'WHERE';
    }
}
