<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component;

use UIAwesome\Html\Core\Component\Base\BaseNavBar;

/**
 * Represents a navigation bar component with brand, menu, and collapsible toggle elements.
 *
 * Renders a `<nav>` wrapper composed of brand text/image/link, a {@see Menu} of {@see Item} entries, and an optional
 * collapse {@see Toggle}. Apply framework-specific styling through
 * {@see \UIAwesome\Html\Core\Base\BaseTag::config()} with a {@see \UIAwesome\Html\Core\Theme\ThemeInterface}
 * implementation.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\NavBar::tag()
 *     ->brandText('My App')
 *     ->brandLink('/')
 *     ->render();
 * ```
 */
class NavBar extends BaseNavBar {}
