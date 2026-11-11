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
     * Whether {@see linkAriaCurrent()} was called, so a parent component keeps the chosen flag.
     */
    private bool $ownLinkAriaCurrent = false;

    /**
     * Returns whether the component chose its own `aria-current` emission flag.
     *
     * A parent component applies its default flag only to children that did not, so an explicit choice is never
     * replaced by a theme default.
     *
     * @return bool `true` when {@see linkAriaCurrent()} was called; `false` otherwise.
     */
    public function hasOwnLinkAriaCurrent(): bool
    {
        return $this->ownLinkAriaCurrent;
    }

    /**
     * Returns `true` when the active link emits the `aria-current` attribute.
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
     * @param bool $value `true` to emit `aria-current` on the active link; `false` to omit it.
     *
     * @return static New instance with the updated `linkAriaCurrent` value.
     */
    public function linkAriaCurrent(bool $value = true): static
    {
        $new = clone $this;
        $new->linkAriaCurrent = $value;
        $new->ownLinkAriaCurrent = true;

        return $new;
    }
}
