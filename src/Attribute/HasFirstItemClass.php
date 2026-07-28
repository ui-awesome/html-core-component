<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Attribute;

use Stringable;
use UnitEnum;

/**
 * Provides an immutable API for the CSS class applied to the first menu item.
 *
 * The stored value is consumed by {@see \UIAwesome\Html\Core\Component\Menu} during iteration and propagated to the
 * first `<li>` via {@see HasListItemCollection::listItemClass()}, replacing any class already set on that item.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Global_attributes/class
 */
trait HasFirstItemClass
{
    /**
     * @var array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum CSS class (or class list) applied to the first
     * menu item.
     */
    protected array|string|Stringable|UnitEnum $firstItemClass = '';

    /**
     * Sets the CSS class applied to the first menu item.
     *
     * Usage example:
     * ```php
     * $menu->firstItemClass('first');
     * $menu->firstItemClass(['first', 'highlight']);
     * $menu->firstItemClass(Theme::PRIMARY);
     * ```
     *
     * @param array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum $value CSS class applied to the first item.
     *
     * @return static New instance with the updated `firstItemClass` value.
     */
    public function firstItemClass(array|string|Stringable|UnitEnum $value): static
    {
        $new = clone $this;
        $new->firstItemClass = $value;

        return $new;
    }
}
