<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component;

use UIAwesome\Html\Contracts\RenderableInterface;

/**
 * Provide methods for handling HTML elements that can be toggled.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
interface ToggleInterface extends RenderableInterface
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
