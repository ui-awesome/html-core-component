<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Attribute;

use Stringable;
use UnitEnum;

/**
 * Provides an immutable API for the CSS class applied to the active `<li>` list item.
 *
 * The stored value is consumed by {@see \UIAwesome\Html\Core\Component\Menu} and propagated to the active item's `<li>`
 * via {@see HasListItemCollection::listItemClass()}.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Global_attributes/class
 */
trait HasListItemActiveClass
{
    /**
     * @var array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum CSS class (or class list) applied to the active
     * `<li>`.
     */
    protected array|string|Stringable|UnitEnum $listItemActiveClass = '';
    /**
     * Whether {@see listItemActiveClass()} replaces existing classes (`true`) or merges into them (`false`).
     */
    protected bool $overrideListItemActiveClass = false;

    /**
     * Sets the CSS class applied to the active list item.
     *
     * Usage example:
     * ```php
     * $menu->listItemActiveClass('active');
     * $menu->listItemActiveClass(['active', 'is-current']);
     * $menu->listItemActiveClass(State::ACTIVE);
     * $menu->listItemActiveClass('active', true);
     * ```
     *
     * @param array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum $value CSS class applied to the active
     * `<li>`.
     * @param bool $override Whether to replace existing classes (`true`) or merge (`false`).
     *
     * @return static New instance with the updated `listItemActiveClass` value.
     */
    public function listItemActiveClass(array|string|Stringable|UnitEnum $value, bool $override = false): static
    {
        $new = clone $this;

        $new->listItemActiveClass = $value;
        $new->overrideListItemActiveClass = $override;

        return $new;
    }
}
