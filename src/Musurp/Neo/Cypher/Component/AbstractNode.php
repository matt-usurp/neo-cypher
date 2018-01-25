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
use Musurp\Neo\Cypher\Utility\MapHelper;

abstract class AbstractNode extends AbstractComponent
{
    /** @var string|null */
    protected $variable;

    /** @var string[] */
    protected $labels = [];

    /** @var array */
    protected $properties = [];

    /**
     * Constructor.
     *
     * @param string|null $variable
     * @param string[] $labels
     * @param array $properties
     */
    public function __construct(?string $variable, array $labels, array $properties)
    {
        $this->variable = $variable;
        $this->labels = $labels;
        $this->properties = $properties;
    }

    /**
     * Return the node container sprintf() expression.
     *
     * @return string
     */
    abstract protected function getNodeContainer(): string;

    /**
     * Return the label glue.
     *
     * @return string
     */
    abstract protected function getLabelGlue(): string;

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function compile(): string
    {
        $string = $this->variable ?: '';

        if (count($labels = array_filter($this->labels))) {
            $string = sprintf('%s:%s', $string, implode($this->getLabelGlue(), $labels));
        }

        if (count($properties = array_filter($this->properties))) {
            $map = MapHelper::map($properties);

            if ($string === '') {
                $string = $map;
            } else {
                $string = implode(' ', [
                    $string,
                    $map,
                ]);
            }
        }

        return sprintf($this->getNodeContainer(), $string);
    }
}
