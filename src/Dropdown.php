<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component;

use UIAwesome\Html\Core\Component\Base\BaseDropdown;

/**
 * Represents a dropdown component composed of a toggle and a collapsible list of items.
 *
 * Renders a `<div>` wrapper enclosing a {@see Toggle} and a {@see Menu} of {@see Item} entries. Apply
 * framework-specific styling through {@see \UIAwesome\Html\Core\Base\BaseTag::config()} with a
 * {@see \UIAwesome\Html\Core\Theme\ThemeInterface} implementation.
 */
class Dropdown extends BaseDropdown {}
