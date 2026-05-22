<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Mixin;

/**
 * Provides an immutable API for opting menu items into automatic activation based on the current request path.
 *
 * When enabled, items whose {@see HasCurrentPath::currentPath()} matches their link are rendered in the active state by
 * the consuming component (typically {@see \UIAwesome\Html\Core\Component\Menu}).
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait CanBeActivateItems
{
    /**
     * Whether automatic activation of menu items is enabled.
     */
    protected bool $activateItems = true;

    /**
     * Toggles automatic activation of menu items.
     *
     * Usage example:
     * ```php
     * $menu->activateItems(false);
     * ```
     *
     * @param bool $value `true` to activate items whose link matches the current path; `false` to disable.
     *
     * @return static New instance with the updated `activateItems` value.
     */
    public function activateItems(bool $value = true): static
    {
        $new = clone $this;

        $new->activateItems = $value;

        return $new;
    }

    /**
     * Returns `true` when automatic activation of menu items is enabled.
     *
     * Usage example:
     * ```php
     * if ($menu->isActivateItems()) {
     *     // ...
     * }
     * ```
     *
     * @return bool Current `activateItems` flag.
     */
    public function isActivateItems(): bool
    {
        return $this->activateItems;
    }
}
