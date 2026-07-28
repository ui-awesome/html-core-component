<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Attribute;

use Stringable;
use UnitEnum;

/**
 * Provides an immutable API for the CSS class applied to the active menu-item link.
 *
 * The stored value is consumed by {@see \UIAwesome\Html\Core\Component\Menu} and propagated to the active link via
 * {@see HasLinkCollection::linkClass()}, replacing any class already set on that link.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Global_attributes/class
 */
trait HasLinkActiveClass
{
    /**
     * @var array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum CSS class (or class list) applied to the active
     * link.
     */
    protected array|string|Stringable|UnitEnum $linkActiveClass = '';

    /**
     * Sets the CSS class applied to the active link.
     *
     * Usage example:
     * ```php
     * $menu->linkActiveClass('active');
     * $menu->linkActiveClass(['active', 'is-current']);
     * $menu->linkActiveClass(State::ACTIVE);
     * ```
     *
     * @param array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum $value CSS class applied to the active link.
     *
     * @return static New instance with the updated `linkActiveClass` value.
     */
    public function linkActiveClass(array|string|Stringable|UnitEnum $value): static
    {
        $new = clone $this;

        $new->linkActiveClass = $value;

        return $new;
    }
}
