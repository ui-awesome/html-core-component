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
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Dropdown::tag()
 *     ->items(
 *         \UIAwesome\Html\Core\Component\Item::tag()->label('Profile')->link('/profile'),
 *         \UIAwesome\Html\Core\Component\Item::tag()->label('Sign out')->link('/logout'),
 *     )
 *     ->render();
 * ```
 */
class Dropdown extends BaseDropdown {}
