<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Mixin;

use InvalidArgumentException;
use UIAwesome\Html\Core\Component\Base\BaseToggle;
use UIAwesome\Html\Core\Component\ToggleInterface;
use UnitEnum;

use function get_debug_type;
use function is_string;

/**
 * Provides an immutable API for assigning a toggle element to a component.
 *
 * The toggle is either a raw string (rendered verbatim) or a {@see ToggleInterface} instance that receives the owning
 * component's id via {@see ToggleInterface::dataValue()} when rendered. A {@see toggleLabel()} replaces the content of
 * a {@see BaseToggle} at render time, whichever toggle applies. Consuming classes must expose {@see getAttribute()}
 * (supplied by {@see HasAttributes}, inherited through {@see BaseBlock}).
 */
trait HasToggle
{
    /**
     * Toggle element rendered alongside the component (raw markup or {@see ToggleInterface} instance).
     */
    protected string|ToggleInterface $toggle = '';
    /**
     * Label replacing the toggle content at render time, or an empty string to keep the toggle content.
     */
    protected string $toggleLabel = '';
    /**
     * Whether {@see toggle()} was called, so a parent component keeps the chosen toggle.
     */
    private bool $ownToggle = false;

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
     * Returns whether the component chose its own toggle.
     *
     * A parent component applies its default toggle only to children that did not, so an explicit toggle is never
     * replaced by a theme default.
     *
     * @return bool `true` when {@see toggle()} was called; `false` otherwise.
     */
    public function hasOwnToggle(): bool
    {
        return $this->ownToggle;
    }

    /**
     * Sets the toggle element.
     *
     * @param string|ToggleInterface $value Raw markup or a {@see ToggleInterface} instance.
     *
     * @return static New instance with the updated `toggle` value.
     */
    public function toggle(string|ToggleInterface $value): static
    {
        $new = clone $this;
        $new->toggle = $value;
        $new->ownToggle = true;

        return $new;
    }

    /**
     * Sets the label replacing the content of the applied toggle, keeping its markup and styling.
     *
     * The toggle itself is not chosen, so a parent component still applies its default toggle. The label is encoded
     * like any other content.
     *
     * @param string $value Label text, or an empty string to keep the toggle content.
     *
     * @return static New instance with the updated `toggleLabel` value.
     */
    public function toggleLabel(string $value): static
    {
        $new = clone $this;
        $new->toggleLabel = $value;

        return $new;
    }

    /**
     * Renders the assigned toggle, binding the owning component's id when the toggle is a {@see ToggleInterface}.
     *
     * @throws InvalidArgumentException When a {@see toggleLabel()} is set and the toggle is not a {@see BaseToggle}.
     *
     * @return string Rendered HTML for the toggle, or the raw string when assigned verbatim.
     */
    protected function renderToggle(): string
    {
        $toggle = $this->toggle;

        if ($this->toggleLabel !== '') {
            if ($toggle instanceof BaseToggle === false) {
                $type = get_debug_type($toggle);

                throw new InvalidArgumentException(
                    "Toggle label '{$this->toggleLabel}' requires a `BaseToggle` toggle, `{$type}` given.",
                );
            }

            $toggle = $toggle->clearContent()->content($this->toggleLabel);
        }

        if (is_string($toggle)) {
            return $toggle;
        }

        $id = $this->getAttribute('id', '');

        return $toggle->dataValue(is_string($id) ? $id : '')->render();
    }
}
