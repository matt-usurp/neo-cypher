<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Tests\Unit\Component;

use Musurp\Neo\Cypher\Component\HashMap;

use PHPUnit\Framework\TestCase;

class HashMapTest extends TestCase
{
    /**
     * @test
     *
     * @group unit
     * @group component
     *
     * @covers \Musurp\Neo\Cypher\Component\Path
     */
    public function canHandleBasicHashMap(): void
    {
        $map = new HashMap([
            'foo' => 'bar',
            'one' => [
                'two' => 'three',
            ],
        ]);

        $cypher = <<<CYPHER
{foo: 'bar', one: {two: 'three'}}
CYPHER;

        self::assertEquals($cypher, $map->compile());
    }
}
