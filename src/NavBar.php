<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component;

use UIAwesome\Html\Core\Component\Base\BaseNavBar;

/**
 * Represents a navigation bar component with brand, menu, and collapsible toggle elements.
 *
 * Renders a `<nav>` wrapper composed of brand text/image/link, a {@see Menu} of {@see Item} entries, and an optional
 * collapse {@see Toggle}. Pair with a cookbook recipe (e.g. {for example, Cookbook\Bootstrap5\NavBar\Defaults}) to
 * apply framework-specific styling.
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
