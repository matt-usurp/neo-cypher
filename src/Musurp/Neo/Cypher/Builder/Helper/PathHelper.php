<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Builder\Helper;

use Musurp\Neo\Cypher\Component\Path;
use Musurp\Neo\Cypher\Component\Path\Node;
use Musurp\Neo\Cypher\Component\Path\RelationshipNode;

class PathHelper
{
    public function create(?string $variable, array $labels, array $properties): Path
    {
        return new Path($this->node($variable, $labels, $properties));
    }

    public function node(?string $variable, array $labels, array $properties): Node
    {
        return new Node($variable, $labels, $properties);
    }

    public function relationshipNode(?string $variable, array $labels, array $properties): RelationshipNode
    {
        return new RelationshipNode($variable, $labels, $properties);
    }
}
