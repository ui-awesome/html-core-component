<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Values;

/**
 * Represents the component states this package defines for {@see \UIAwesome\Html\Core\Config\ComponentContext}.
 *
 * Pass the backing value in the context states so themes resolve recipes for the active state.
 */
enum ComponentState: string
{
    /**
     * `dismissible` — Marks an {@see \UIAwesome\Html\Core\Component\Alert} that the user can close.
     */
    case DISMISSIBLE = 'dismissible';
}
