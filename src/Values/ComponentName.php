<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Values;

/**
 * Represents the component identifiers this package defines for {@see \UIAwesome\Html\Core\Config\ComponentContext}.
 *
 * Pass the backing value as the context component so themes resolve recipes for the matching component.
 */
enum ComponentName: string
{
    /**
     * `alert` — Identifies the {@see \UIAwesome\Html\Core\Component\Alert} component.
     */
    case ALERT = 'alert';

    /**
     * `breadcrumb` — Identifies the {@see \UIAwesome\Html\Core\Component\Breadcrumb} component.
     */
    case BREADCRUMB = 'breadcrumb';

    /**
     * `dropdown` — Identifies the {@see \UIAwesome\Html\Core\Component\Dropdown} component.
     */
    case DROPDOWN = 'dropdown';

    /**
     * `item` — Identifies the {@see \UIAwesome\Html\Core\Component\Item} component.
     */
    case ITEM = 'item';

    /**
     * `menu` — Identifies the {@see \UIAwesome\Html\Core\Component\Menu} component.
     */
    case MENU = 'menu';

    /**
     * `navbar` — Identifies the {@see \UIAwesome\Html\Core\Component\NavBar} component.
     */
    case NAVBAR = 'navbar';

    /**
     * `toggle` — Identifies the {@see \UIAwesome\Html\Core\Component\Toggle} component.
     */
    case TOGGLE = 'toggle';
}
