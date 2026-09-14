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
 */
class Breadcrumb extends BaseBreadcrumb {}
