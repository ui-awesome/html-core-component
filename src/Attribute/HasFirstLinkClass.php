<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Attribute;

use Stringable;
use UnitEnum;

/**
 * Provides an immutable API for the CSS class applied to the first menu-item link.
 *
 * The stored value is consumed by {@see \UIAwesome\Html\Core\Component\Menu} during iteration and propagated to the
 * first link via {@see HasLinkCollection::linkClass()}.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Global_attributes/class
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasFirstLinkClass
{
    /**
     * @var array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum CSS class (or class list) applied to the first
     * menu-item link.
     */
    protected array|string|Stringable|UnitEnum $firstLinkClass = '';
    /**
     * Whether {@see firstLinkClass()} replaces existing classes (`true`) or merges into them (`false`).
     */
    protected bool $overrideFirstLinkClass = true;

    /**
     * Sets the CSS class applied to the first menu-item link.
     *
     * Usage example:
     * ```php
     * $menu->firstLinkClass('first-link');
     * $menu->firstLinkClass(['first-link', 'highlight']);
     * $menu->firstLinkClass(Theme::PRIMARY);
     * $menu->firstLinkClass('first-link', false);
     * ```
     *
     * @param array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum $value CSS class applied to the first link.
     * @param bool $override Whether to replace existing classes (`true`) or merge (`false`).
     *
     * @return static New instance with the updated `firstLinkClass` value.
     */
    public function firstLinkClass(array|string|Stringable|UnitEnum $value, bool $override = true): static
    {
        $new = clone $this;

        $new->firstLinkClass = $value;
        $new->overrideFirstLinkClass = $override;

        return $new;
    }
}
