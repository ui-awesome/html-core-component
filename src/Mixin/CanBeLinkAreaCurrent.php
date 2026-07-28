<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Mixin;

/**
 * Provides an immutable API for toggling the `aria-current` attribute on the active link of a menu item.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/Attributes/aria-current
 */
trait CanBeLinkAreaCurrent
{
    /**
     * Whether the `aria-current` attribute is emitted on the active link.
     */
    protected bool $linkAriaCurrent = false;

    /**
     * Returns `true` when the active link emits the `aria-current` attribute.
     *
     * Usage example:
     * ```php
     * if ($menu->isLinkAriaCurrent()) {
     *     // ...
     * }
     * ```
     *
     * @return bool Current `linkAriaCurrent` flag.
     */
    public function isLinkAriaCurrent(): bool
    {
        return $this->linkAriaCurrent;
    }

    /**
     * Toggles emission of the `aria-current` attribute on the active link.
     *
     * Usage example:
     * ```php
     * $menu->linkAriaCurrent(true);
     * ```
     *
     * @param bool $value `true` to emit `aria-current` on the active link; `false` to omit it.
     *
     * @return static New instance with the updated `linkAriaCurrent` value.
     */
    public function linkAriaCurrent(bool $value = true): static
    {
        $new = clone $this;
        $new->linkAriaCurrent = $value;

        return $new;
    }
}
