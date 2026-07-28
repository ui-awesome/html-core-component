<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Attribute;

use Stringable;
use UnitEnum;

/**
 * Provides an immutable API for the CSS class applied to a disabled `<li>` list item.
 *
 * The stored value is consumed by {@see \UIAwesome\Html\Core\Component\Menu} and propagated to the `<li>` of disabled
 * items via {@see HasListItemCollection::listItemClass()}, replacing any class already set on that item.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Global_attributes/class
 */
trait HasListItemDisabledClass
{
    /**
     * @var array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum CSS class (or class list) applied to a disabled
     * `<li>`.
     */
    protected array|string|Stringable|UnitEnum $listItemDisabledClass = '';

    /**
     * Sets the CSS class applied to a disabled list item.
     *
     * Usage example:
     * ```php
     * $menu->listItemDisabledClass('disabled');
     * $menu->listItemDisabledClass(['disabled', 'is-muted']);
     * $menu->listItemDisabledClass(State::DISABLED);
     * ```
     *
     * @param array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum $value CSS class applied to a disabled
     * `<li>`.
     *
     * @return static New instance with the updated `listItemDisabledClass` value.
     */
    public function listItemDisabledClass(array|string|Stringable|UnitEnum $value): static
    {
        $new = clone $this;
        $new->listItemDisabledClass = $value;

        return $new;
    }
}
