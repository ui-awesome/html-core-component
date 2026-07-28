<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component;

use UIAwesome\Html\Core\Component\Base\BaseAlert;

/**
 * Represents a dismissible alert component for surfacing contextual messages.
 *
 * Renders a `<div role="alert">` wrapper composed of a prefix, content, suffix, and an optional toggle. Apply
 * framework-specific styling through {@see \UIAwesome\Html\Core\Base\BaseTag::config()} with a
 * {@see \UIAwesome\Html\Core\Theme\ThemeInterface} implementation.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Alert::tag()
 *     ->content('Watch out!')
 *     ->render();
 * ```
 */
class Alert extends BaseAlert {}
