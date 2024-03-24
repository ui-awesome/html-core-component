<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

/**
 * Is used by widgets that implement the list item area current attribute.
 */
trait CanBeListItemAreaCurrent
{
    protected bool $listItemAriaCurrent = false;

    /**
     * Set the list item aria current attribute.
     *
     * @param bool $value Whether the list item aria current attribute is `true` or `false`.
     * If `true` the add aria-current attribute to the list item <li> element.
     *
     * @return static A new instance of the current class with the specified list item aria current attribute.
     */
    public function listItemAriaCurrent(bool $value = true): static
    {
        $new = clone $this;
        $new->listItemAriaCurrent = $value;

        return $new;
    }

    /**
     * Check if the list item aria current attribute is `true` or `false`.
     */
    public function isListItemAriaCurrent(): bool
    {
        return $this->listItemAriaCurrent;
    }
}
