<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

/**
 * Is used by widgets that implement the visible method.
 */
trait CanBeVisible
{
    protected bool $visible = true;

    /**
     * Set the visible state.
     *
     * @param bool $value The visible state.
     *
     * @return static A new instance of the current class with the specified visible state.
     */
    public function visible(bool $value = true): static
    {
        $new = clone $this;
        $new->visible = $value;

        return $new;
    }

    /**
     * Check if the widget is visible.
     *
     * @return bool Whether the widget is visible or not.
     */
    public function isVisible(): bool
    {
        return $this->visible;
    }
}
