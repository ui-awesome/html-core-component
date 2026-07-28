<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Attribute;

use Stringable;
use UnitEnum;

/**
 * Provides an immutable API for the CSS class applied to a disabled menu-item link.
 *
 * The stored value is consumed by {@see \UIAwesome\Html\Core\Component\Menu} and propagated to the link of disabled
 * items via {@see HasLinkCollection::linkClass()}, replacing any class already set on that link.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Global_attributes/class
 */
trait HasLinkDisabledClass
{
    /**
     * @var array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum CSS class (or class list) applied to a disabled
     * link.
     */
    protected array|string|Stringable|UnitEnum $linkDisabledClass = '';

    /**
     * Sets the CSS class applied to a disabled link.
     *
     * Usage example:
     * ```php
     * $menu->linkDisabledClass('disabled');
     * $menu->linkDisabledClass(['disabled', 'is-muted']);
     * $menu->linkDisabledClass(State::DISABLED);
     * ```
     *
     * @param array<string|Stringable|UnitEnum>|string|Stringable|UnitEnum $value CSS class applied to a disabled link.
     *
     * @return static New instance with the updated `linkDisabledClass` value.
     */
    public function linkDisabledClass(array|string|Stringable|UnitEnum $value): static
    {
        $new = clone $this;
        $new->linkDisabledClass = $value;

        return $new;
    }
}
