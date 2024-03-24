<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Interop;

use UIAwesome\Html\Interop\RenderInterface;

/**
 * Provide methods for handling HTML elements that can be toggled.
 */
interface ToggleInterface extends RenderInterface
{
    /**
     * Set the `HTML` data-value attribute for the toggle.
     *
     * @param string $value The data-value attribute value.
     *
     * @return static A new instance of the current class with the specified toggle attributes.
     */
    public function dataValue(string $value): static;
}
