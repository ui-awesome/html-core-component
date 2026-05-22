<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Attribute;

use Stringable;
use UnitEnum;

/**
 * Provides an immutable API for the CSS class applied to the last menu-item link.
 *
 * The stored value is consumed by {@see \UIAwesome\Html\Core\Component\Menu} during iteration and propagated to the
 * last link via {@see HasLinkCollection::linkClass()}.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Global_attributes/class
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasLastLinkClass
{
    /**
     * @var array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum CSS class (or class list) applied to the last
     * menu-item link.
     */
    protected array|string|Stringable|UnitEnum $lastLinkClass = '';
    /**
     * Whether {@see lastLinkClass()} replaces existing classes (`true`) or merges into them (`false`).
     */
    protected bool $overrideLastLinkClass = true;

    /**
     * Sets the CSS class applied to the last menu-item link.
     *
     * Usage example:
     * ```php
     * $menu->lastLinkClass('last-link');
     * $menu->lastLinkClass(['last-link', 'highlight']);
     * $menu->lastLinkClass(Theme::PRIMARY);
     * $menu->lastLinkClass('last-link', false);
     * ```
     *
     * @param array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum $value CSS class applied to the last link.
     * @param bool $override Whether to replace existing classes (`true`) or merge (`false`).
     *
     * @return static New instance with the updated `lastLinkClass` value.
     */
    public function lastLinkClass(array|string|Stringable|UnitEnum $value, bool $override = true): static
    {
        $new = clone $this;

        $new->lastLinkClass = $value;
        $new->overrideLastLinkClass = $override;

        return $new;
    }
}
