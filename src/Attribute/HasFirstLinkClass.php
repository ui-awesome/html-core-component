<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Attribute;

use Stringable;
use UnitEnum;

/**
 * Provides an immutable API for the CSS class applied to the first menu-item link.
 *
 * The stored value is consumed by {@see \UIAwesome\Html\Core\Component\Menu} during iteration and propagated to the
 * first link via {@see HasLinkCollection::linkClass()}, replacing any class already set on that link.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Global_attributes/class
 */
trait HasFirstLinkClass
{
    /**
     * @var array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum CSS class (or class list) applied to the first
     * menu-item link.
     */
    protected array|string|Stringable|UnitEnum $firstLinkClass = '';

    /**
     * Sets the CSS class applied to the first menu-item link.
     *
     * Usage example:
     * ```php
     * $menu->firstLinkClass('first-link');
     * $menu->firstLinkClass(['first-link', 'highlight']);
     * $menu->firstLinkClass(Theme::PRIMARY);
     * ```
     *
     * @param array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum $value CSS class applied to the first link.
     *
     * @return static New instance with the updated `firstLinkClass` value.
     */
    public function firstLinkClass(array|string|Stringable|UnitEnum $value): static
    {
        $new = clone $this;
        $new->firstLinkClass = $value;

        return $new;
    }
}
