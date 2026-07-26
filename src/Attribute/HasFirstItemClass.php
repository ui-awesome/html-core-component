<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Attribute;

use Stringable;
use UnitEnum;

/**
 * Provides an immutable API for the CSS class applied to the first menu item.
 *
 * The stored value is consumed by {@see \UIAwesome\Html\Core\Component\Menu} during iteration and propagated to the
 * first `<li>` via {@see HasListItemCollection::listItemClass()}.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Global_attributes/class
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasFirstItemClass
{
    /**
     * @var array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum CSS class (or class list) applied to the first
     * menu item.
     */
    protected array|string|Stringable|UnitEnum $firstItemClass = '';
    /**
     * Whether {@see firstItemClass()} replaces existing classes (`true`) or merges into them (`false`).
     */
    protected bool $overrideFirstItemClass = true;

    /**
     * Sets the CSS class applied to the first menu item.
     *
     * Usage example:
     * ```php
     * $menu->firstItemClass('first');
     * $menu->firstItemClass(['first', 'highlight']);
     * $menu->firstItemClass(Theme::PRIMARY);
     * $menu->firstItemClass('first', false);
     * ```
     *
     * @param array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum $value CSS class applied to the first item.
     * @param bool $override Whether to replace existing classes (`true`) or merge (`false`).
     *
     * @return static New instance with the updated `firstItemClass` value.
     */
    public function firstItemClass(array|string|Stringable|UnitEnum $value, bool $override = true): static
    {
        $new = clone $this;

        $new->firstItemClass = $value;
        $new->overrideFirstItemClass = $override;

        return $new;
    }
}
