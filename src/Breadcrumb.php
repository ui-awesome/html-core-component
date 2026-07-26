<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component;

use UIAwesome\Html\Core\Component\Base\BaseBreadcrumb;

/**
 * Represents a breadcrumb navigation component for displaying a hierarchical trail of links.
 *
 * Renders a `<nav>` wrapper enclosing an ordered list of {@see Item} elements with active-path detection. Pair with a
 * cookbook recipe (for example, {@see Cookbook\Bootstrap5\Breadcrumb\Defaults}) to apply framework-specific styling.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Breadcrumb::tag()
 *     ->currentPath('/reports')
 *     ->items(
 *         \UIAwesome\Html\Core\Component\Item::tag()->label('Home')->link('/'),
 *         \UIAwesome\Html\Core\Component\Item::tag()->label('Reports')->link('/reports'),
 *     )
 *     ->render();
 * ```
 */
class Breadcrumb extends BaseBreadcrumb {}
