<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Exception;

/**
 * {@inheritdoc}
 */
class ComponentRuntimeException extends \RuntimeException
{
    /**
     * @param string $direction
     * @param array $directions
     *
     * @return ComponentRuntimeException
     */
    public static function createForInvalidRelationshipDirection(string $direction, array $directions): self
    {
        return new self('invalid direction given');
    }
}
