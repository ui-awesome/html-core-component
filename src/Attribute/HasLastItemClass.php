<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Attribute;

use Stringable;
use UnitEnum;

/**
 * Provides an immutable API for the CSS class applied to the last menu item.
 *
 * The stored value is consumed by {@see \UIAwesome\Html\Core\Component\Menu} during iteration and propagated to the
 * last `<li>` via {@see HasListItemCollection::listItemClass()}.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Global_attributes/class
 */
trait HasLastItemClass
{
    /**
     * @var array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum CSS class (or class list) applied to the last
     * menu item.
     */
    protected array|string|Stringable|UnitEnum $lastItemClass = '';
    /**
     * Whether {@see lastItemClass()} replaces existing classes (`true`) or merges into them (`false`).
     */
    protected bool $overrideLastItemClass = true;

    /**
     * Sets the CSS class applied to the last menu item.
     *
     * Usage example:
     * ```php
     * $menu->lastItemClass('last');
     * $menu->lastItemClass(['last', 'highlight']);
     * $menu->lastItemClass(Theme::PRIMARY);
     * $menu->lastItemClass('last', false);
     * ```
     *
     * @param array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum $value CSS class applied to the last item.
     * @param bool $override Whether to replace existing classes (`true`) or merge (`false`).
     *
     * @return static New instance with the updated `lastItemClass` value.
     */
    public function lastItemClass(array|string|Stringable|UnitEnum $value, bool $override = true): static
    {
        $new = clone $this;

        $new->lastItemClass = $value;
        $new->overrideLastItemClass = $override;

        return $new;
    }
}
