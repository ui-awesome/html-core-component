<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Attribute;

use Stringable;
use UnitEnum;

/**
 * Provides an immutable API for the CSS class applied to the last menu-item link.
 *
 * The stored value is consumed by {@see \UIAwesome\Html\Core\Component\Menu} during iteration and propagated to the
 * last link via {@see HasLinkCollection::linkClass()}, replacing any class already set on that link.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Global_attributes/class
 */
trait HasLastLinkClass
{
    /**
     * @var array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum CSS class (or class list) applied to the last
     * menu-item link.
     */
    protected array|string|Stringable|UnitEnum $lastLinkClass = '';

    /**
     * Sets the CSS class applied to the last menu-item link.
     *
     * Usage example:
     * ```php
     * $menu->lastLinkClass('last-link');
     * $menu->lastLinkClass(['last-link', 'highlight']);
     * $menu->lastLinkClass(Theme::PRIMARY);
     * ```
     *
     * @param array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum $value CSS class applied to the last link.
     *
     * @return static New instance with the updated `lastLinkClass` value.
     */
    public function lastLinkClass(array|string|Stringable|UnitEnum $value): static
    {
        $new = clone $this;

        $new->lastLinkClass = $value;

        return $new;
    }
}
