<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

/**
 * Is used by widgets that implement the disable method.
 */
trait CanBeDisable
{
    protected bool $disable = false;

    /**
     * Set the disable state.
     *
     * @param bool $value The disable state.
     *
     * @return static A new instance of the current class with the specified disable state.
     */
    public function disable(bool $value = true): static
    {
        $new = clone $this;
        $new->disable = $value;

        return $new;
    }

    /**
     * @return bool Whether the menu item is disable.
     */
    public function isDisable(): bool
    {
        return $this->disable;
    }
}
