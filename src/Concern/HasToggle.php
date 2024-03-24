<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Concern;

use UIAwesome\Html\{Core\Component\Interop\ToggleInterface, Helper\Sanitize};

/**
 * Is used by widgets that implement the toggle method.
 */
trait HasToggle
{
    protected string|ToggleInterface $toggle = '';

    /**
     * Set the content of the toggle button.
     *
     * @param ToggleInterface|string $value The content of the toggle button.
     *
     * @return static A new instance of the current class with the specified toggle button content.
     */
    public function toggle(string|ToggleInterface $value): static
    {
        if (is_string($value)) {
            $value = Sanitize::html($value);
        }

        $new = clone $this;
        $new->toggle = $value;

        return $new;
    }
}
