<?php

namespace Musurp\Neo\Cypher\Component\Expression;

use Musurp\Neo\Cypher\AbstractComponent;

/**
 * A catch-all kind of component that allows any input to be added anywhere.
 *
 * This component is not recommended for general use but can be used when ever a syntax element
 * is missing but mentioned in the docs.
 *
 * @deprecated to be removed in 1.0
 */
class AmbiguousComponent extends AbstractComponent
{
    private $value;

    /**
     * Constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        return $this->value;
    }
}
