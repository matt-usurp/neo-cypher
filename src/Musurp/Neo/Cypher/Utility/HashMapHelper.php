<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Utility;

/**
 * A hash map helper within the Cypher syntax.
 */
final class HashMapHelper
{
    /**
     * @param array $properties
     * @param string|null $alias
     *
     * @return string
     */
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

    /**
     * @param array $properties
     *
     * @return string
     */
    public static function map(array $properties): string
    {
        $parts = [];

        if (count($properties) === 0) {
            return '{}';
        }

        foreach ($properties as $key => $value) {
            $formatted = $value;

            if (is_array($value)) {
                if (count($value) === 0) {
                    continue;
                }
                $formatted = self::map($value);
            } elseif (is_string($value)) {
                $formatted = sprintf('\'%s\'', addslashes($value));
            } elseif (is_bool($value)) {
                $formatted = $value ? 1 : 0;
            } elseif (is_null($value)) {
                $formatted = 'null';
            }

            $parts[] = sprintf('%s: %s', $key, $formatted);
        }

        return sprintf('{%s}', join(', ', $parts));
    }
}
