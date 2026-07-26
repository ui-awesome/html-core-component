<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Mixin;

/**
 * Provides an immutable API for toggling the `aria-current` attribute on the active `<li>` of a menu item.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/Attributes/aria-current
 */
trait CanBeListItemAreaCurrent
{
    /**
     * Whether the `aria-current` attribute is emitted on the active list item.
     */
    protected bool $listItemAriaCurrent = false;

    /**
     * Returns `true` when the active list item emits the `aria-current` attribute.
     *
     * Usage example:
     * ```php
     * if ($menu->isListItemAriaCurrent()) {
     *     // ...
     * }
     * ```
     *
     * @return bool Current `listItemAriaCurrent` flag.
     */
    public function isListItemAriaCurrent(): bool
    {
        return $this->listItemAriaCurrent;
    }

    /**
     * Toggles emission of the `aria-current` attribute on the active list item.
     *
     * Usage example:
     * ```php
     * $menu->listItemAriaCurrent(true);
     * ```
     *
     * @param bool $value `true` to emit `aria-current` on the active `<li>`; `false` to omit it.
     *
     * @return static New instance with the updated `listItemAriaCurrent` value.
     */
    public function listItemAriaCurrent(bool $value = true): static
    {
        $new = clone $this;

        $new->listItemAriaCurrent = $value;

        return $new;
    }
}
