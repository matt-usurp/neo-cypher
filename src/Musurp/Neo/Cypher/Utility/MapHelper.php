<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Utility;

final class MapHelper
{
    public static function list(array $properties, ?string $alias): string
    {
        $parts = [];

        foreach ($properties as $key => $value) {
            $formatted = $value;

            if (!is_numeric($value)) {
                $formatted = sprintf('\'%s\'', addslashes($value));
            }

            if ($alias) {
                $key = sprintf('%s.%s', $alias, $key);
            }

            $parts[] = sprintf('%s = %s', $key, $formatted);
        }

        return join(', ', $parts);
    }

    public static function map(array $properties): string
    {
        $parts = [];

        foreach ($properties as $key => $value) {
            $formatted = $value;

            if (is_string($value)) {
                $formatted = sprintf('\'%s\'', addslashes($value));
            }

            $parts[] = sprintf('%s: %s', $key, $formatted);
        }

        return sprintf('{%s}', join(', ', $parts));
    }
}
