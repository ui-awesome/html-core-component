<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

/**
 * Is used by widgets that implement the active method.
 */
trait CanBeActive
{
    protected bool $active = false;

    /**
     * Set the active state.
     *
     * @param bool $value The active state.
     *
     * @return static A new instance of the current class with the specified active state.
     */
    public function active(bool $value = true): static
    {
        $new = clone $this;
        $new->active = $value;

        return $new;
    }
}
