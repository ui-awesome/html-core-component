<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component;

use UIAwesome\Html\Core\Component\Base\BaseToggle;

/**
 * Represents a toggle component rendered as a `<button>` or `<a>` element.
 *
 * Renders a `<button type="button">` by default, switching to `<a>` when {@see BaseToggle::link()} is set. Use data
 * attributes for framework-specific toggle hooks (for example, `data-bs-toggle`, `data-collapse-toggle`). Pair with a
 * cookbook recipe (for example, {@see Cookbook\Bootstrap5\Toggle\Dropdown}) to apply framework-specific styling.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Toggle::tag()
 *     ->content('Open menu')
 *     ->addDataAttribute('bs-toggle', 'collapse')
 *     ->addDataAttribute('bs-target', '#navbar')
 *     ->render();
 * ```
 */
class Toggle extends BaseToggle {}
