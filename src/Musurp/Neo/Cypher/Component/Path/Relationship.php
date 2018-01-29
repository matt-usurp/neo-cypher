<?php

/*
 * This file is part of the "matt-usurp/neo-cypher" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Musurp\Neo\Cypher\Component\Path;

use Musurp\Neo\Cypher\AbstractComponent;
use Musurp\Neo\Cypher\Component\Enum\RelationshipDirectionEnum;
use Musurp\Neo\Cypher\Exception\ComponentRuntimeException;

/**
 * A path relationship.
 */
final class Relationship extends AbstractComponent implements RelationshipDirectionEnum
{
    private $directions = [
        self::DIRECTION_ANY,
        self::DIRECTION_TO,
        self::DIRECTION_FROM,
    ];

    /** @var RelationshipNode|null */
    protected $node;

    /** @var string */
    protected $direction;

    /**
     * Constructor.
     *
     * @param RelationshipNode|null $node
     * @param string $direction
     */
    public function __construct(?RelationshipNode $node, string $direction)
    {
        $this->node = $node;
        $this->direction = $direction;
    }

    /**
     * {@inheritdoc}
     */
    public function compile(bool $pretty = true): string
    {
        switch ($this->direction) {
            case self::DIRECTION_ANY:
                if ($this->node instanceof RelationshipNode) {
                    return sprintf('-%s-', $this->node->compile($pretty));
                }

                return '--';

            case self::DIRECTION_TO:
                if ($this->node instanceof RelationshipNode) {
                    return sprintf('-%s->', $this->node->compile($pretty));
                }

                return '-->';

            case self::DIRECTION_FROM:
                if ($this->node instanceof RelationshipNode) {
                    return sprintf('<-%s-', $this->node->compile($pretty));
                }

                return '<--';

            default:
                throw ComponentRuntimeException::createForInvalidRelationshipDirection(
                    $this->direction,
                    $this->directions
                );
        }
    }
}
