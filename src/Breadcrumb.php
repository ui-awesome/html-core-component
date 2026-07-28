<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component;

use UIAwesome\Html\Core\Component\Base\BaseBreadcrumb;

/**
 * Represents a breadcrumb navigation component for displaying a hierarchical trail of links.
 *
 * Renders a `<nav>` wrapper enclosing an ordered list of {@see Item} elements with active-path detection. Apply
 * framework-specific styling through {@see \UIAwesome\Html\Core\Base\BaseTag::config()} with a
 * {@see \UIAwesome\Html\Core\Theme\ThemeInterface} implementation.
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
