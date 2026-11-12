<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Values;

/**
 * Represents the structural variants this package defines for the {@see \UIAwesome\Html\Core\Component\Toggle}
 * component context.
 *
 * Pass the backing value as the context variant of {@see ComponentName::TOGGLE}.
 */
enum ToggleVariant: string
{
    /**
     * `menu` — Toggle that expands or collapses a navbar menu.
     */
    case MENU = 'menu';

    /**
     * `menu-dropdown` — Toggle that opens a dropdown nested in a menu.
     */
    case MENU_DROPDOWN = 'menu-dropdown';

    /**
     * `selector-theme` — Toggle that opens the color theme selector.
     */
    case SELECTOR_THEME = 'selector-theme';
}
