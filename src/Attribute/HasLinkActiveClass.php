<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Attribute;

use Stringable;
use UnitEnum;

/**
 * Provides an immutable API for the CSS class applied to the active menu-item link.
 *
 * The stored value is consumed by {@see \UIAwesome\Html\Core\Component\Menu} and propagated to the active link via
 * {@see HasLinkCollection::linkClass()}.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Global_attributes/class
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasLinkActiveClass
{
    /**
     * @var array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum CSS class (or class list) applied to the active
     * link.
     */
    protected array|string|Stringable|UnitEnum $linkActiveClass = '';
    /**
     * Whether {@see linkActiveClass()} replaces existing classes (`true`) or merges into them (`false`).
     */
    protected bool $overrideLinkActiveClass = false;

    /**
     * Sets the CSS class applied to the active link.
     *
     * Usage example:
     * ```php
     * $menu->linkActiveClass('active');
     * $menu->linkActiveClass(['active', 'is-current']);
     * $menu->linkActiveClass(State::ACTIVE);
     * $menu->linkActiveClass('active', true);
     * ```
     *
     * @param array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum $value CSS class applied to the active link.
     * @param bool $override Whether to replace existing classes (`true`) or merge (`false`).
     *
     * @return static New instance with the updated `linkActiveClass` value.
     */
    public function linkActiveClass(array|string|Stringable|UnitEnum $value, bool $override = false): static
    {
        $new = clone $this;

        $new->linkActiveClass = $value;
        $new->overrideLinkActiveClass = $override;

        return $new;
    }
}
