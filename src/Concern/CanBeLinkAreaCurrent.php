<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

/**
 * Is used by widgets that implement the link area current attribute.
 */
trait CanBeLinkAreaCurrent
{
    protected bool $linkAriaCurrent = false;

    /**
     * Set the link aria current attribute.
     *
     * @param bool $value Whether the link aria current attribute is `true` or `false`.
     * If `true` the add aria-current attribute to the link.
     *
     * @return static A new instance of the current class with the specified link aria current attribute.
     */
    public function linkAriaCurrent(bool $value = true): static
    {
        $new = clone $this;
        $new->linkAriaCurrent = $value;

        return $new;
    }

    /**
     * Check if the link aria current attribute is `true` or `false`.
     */
    public function isLinkAriaCurrent(): bool
    {
        return $this->linkAriaCurrent;
    }
}
