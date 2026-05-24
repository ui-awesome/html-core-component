<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component;

use UIAwesome\Html\Contracts\RenderableInterface;

/**
 * Contract for toggle elements bound to a parent component identifier.
 *
 * Parent components (such as alerts, dropdowns, and navbars) propagate their `id` to the toggle through
 * {@see dataValue()} so the toggle can emit explicit data hooks (for example, `data-bs-target`, `data-collapse-toggle`)
 * referencing the parent.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
interface ToggleInterface extends RenderableInterface
{
    /**
     * Stores the parent component's identifier on the toggle for subsequent data-attribute composition.
     *
     * Usage example:
     * ```php
     * \UIAwesome\Html\Core\Component\Toggle::tag()->dataValue('navbar-1');
     * ```
     *
     * @param string $value Identifier of the parent component bound to the toggle.
     *
     * @return static New instance with the updated `dataValue` value.
     */
    public function dataValue(string $value): static;
}
