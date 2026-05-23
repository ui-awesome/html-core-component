<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Mixin;

use UIAwesome\Html\Core\Component\ToggleInterface;
use UnitEnum;

use function is_string;

/**
 * Provides an immutable API for assigning a toggle element to a component.
 *
 * The toggle is either a raw string (rendered verbatim) or a {@see ToggleInterface} instance that receives the owning
 * component's id via {@see ToggleInterface::dataValue()} when rendered. Consuming classes must expose
 * {@see getAttribute()} (supplied by {@see HasAttributes}, inherited through {@see BaseBlock}).
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasToggle
{
    /**
     * Toggle element rendered alongside the component (raw markup or {@see ToggleInterface} instance).
     */
    protected string|ToggleInterface $toggle = '';

    /**
     * Returns the value of a single HTML attribute.
     *
     * Provided by {@see HasAttributes} (inherited via {@see BaseBlock}).
     *
     * @param string|UnitEnum $key Attribute name.
     * @param mixed $default Default value when the attribute is missing.
     *
     * @return mixed Attribute value, or {@see $default} when the attribute is not set.
     */
    abstract public function getAttribute(string|UnitEnum $key, mixed $default = null): mixed;

    /**
     * Sets the toggle element.
     *
     * Usage example:
     * ```php
     * $component->toggle('Open');
     * $component->toggle(\UIAwesome\Html\Core\Component\Toggle::tag()->content('Open'));
     * ```
     *
     * @param string|ToggleInterface $value Raw markup or a {@see ToggleInterface} instance.
     *
     * @return static New instance with the updated `toggle` value.
     */
    public function toggle(string|ToggleInterface $value): static
    {
        $new = clone $this;

        $new->toggle = $value;

        return $new;
    }

    /**
     * Renders the assigned toggle, binding the owning component's id when the toggle is a {@see ToggleInterface}.
     *
     * @return string Rendered HTML for the toggle, or the raw string when assigned verbatim.
     */
    protected function renderToggle(): string
    {
        if (is_string($this->toggle)) {
            return $this->toggle;
        }

        $id = $this->getAttribute('id', '');

        return $this->toggle->dataValue(is_string($id) ? $id : '')->render();
    }
}
