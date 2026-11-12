<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Values;

/**
 * Represents the structural variants this package defines for the {@see \UIAwesome\Html\Core\Component\NavBar}
 * component context.
 *
 * Pass the backing value as the context variant of {@see ComponentName::NAVBAR}.
 */
enum NavBarVariant: string
{
    /**
     * `align-right` — Navbar whose menu is aligned to the end of the bar.
     */
    case ALIGN_RIGHT = 'align-right';
}
