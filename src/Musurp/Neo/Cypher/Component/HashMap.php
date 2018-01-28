<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Component;

use Musurp\Neo\Cypher\AbstractComponent;
use Musurp\Neo\Cypher\Utility\HashMapHelper;

/**
 * {@inheritdoc}
 */
final class HashMap extends AbstractComponent
{
    private $map;

    /**
     * Constructor.
     *
     * @param array $map
     */
    public function __construct(array $map)
    {
        $this->map = $map;
    }

    /**
     * {@inheritdoc}
     */
    public function compile(): string
    {
        return HashMapHelper::map($this->map);
    }
}
