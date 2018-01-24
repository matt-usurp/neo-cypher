<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Component\Enum;

interface RelationshipDirectionEnum
{
    const DIRECTION_ANY = 'ANY';
    const DIRECTION_FROM = 'FROM';
    const DIRECTION_TO = 'TO';
}
