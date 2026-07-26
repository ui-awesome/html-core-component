<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Mixin;

/**
 * Provides an immutable API for the current request path used to match active menu items.
 *
 * Consumed by {@see \UIAwesome\Html\Core\Component\Item::isActive()} when {@see CanBeActivateItems::activateItems()} is
 * enabled: an item whose link matches {@see $currentPath} is rendered in the active state.
 */
trait HasCurrentPath
{
    /**
     * Current request path used to match active menu items.
     */
    protected string $currentPath = '';

    /**
     * Sets the current request path.
     *
     * Usage example:
     * ```php
     * $menu->currentPath('/reports');
     * ```
     *
     * @param string $value Current request path used to match active menu items.
     *
     * @return static New instance with the updated `currentPath` value.
     */
    public function currentPath(string $value): static
    {
        $new = clone $this;

        $new->currentPath = $value;

        return $new;
    }
}
